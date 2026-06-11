<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\EmailVerificationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Landing page — cek apakah user sudah pernah lihat onboarding
    public function landing(Request $request) {
        // Jika session onboarding_passed ada, langsung ke login
        if ($request->session()->has('onboarding_passed')) {
            return redirect()->route('login');
        }

        // Jika belum pernah, tampilkan onboarding
        return view('onboarding');
    }

    // Menampilkan Halaman Onboarding (direct access)
    public function showOnboarding() {
        return view('onboarding');
    }

    // Tandai onboarding selesai untuk sesi ini
    public function completeOnboarding(Request $request) {
        $request->session()->put('onboarding_passed', true);
        return redirect()->route('login');
    }

    // Menampilkan Halaman Login
    public function showLogin(Request $request) {
        if (!$request->session()->has('onboarding_passed')) {
            return redirect()->route('onboarding');
        }
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request) {
        $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ], [
            'nim.required' => 'Kolom NIM wajib diisi.',
            'password.required' => 'Kolom Password wajib diisi.',
        ]);

        // Cari berdasarkan NIM atau Email (karena di UI tertulis input your NIM number or email)
        $fieldType = filter_var($request->nim, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        $remember = $request->has('remember');

        if (Auth::attempt([$fieldType => $request->nim, 'password' => $request->password], $remember)) {
            $user = Auth::user();

            // Cek apakah email sudah diverifikasi
            if (!$user->isVerified()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Generate kode baru dan redirect ke verifikasi
                $this->generateAndSendCode($user);

                return redirect()->route('verify', $user->id)
                    ->with('info', 'Email kamu belum diverifikasi. Kode verifikasi baru telah dikirim.');
            }

            $request->session()->regenerate();
            
            // Set cookie for Remember Me pre-fill
            if ($remember) {
                \Illuminate\Support\Facades\Cookie::queue('saved_nim', $request->nim, 60 * 24 * 30); // 30 days
            } else {
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('saved_nim'));
            }

            return redirect()->intended('/dashboard');
        }

        // Jika gagal, kembalikan pesan error
        return back()->withErrors([
            'login_error' => 'NIM atau kata sandi tidak valid. Silakan coba lagi.',
        ])->withInput($request->only('nim'));
    }

    // Menampilkan Halaman Register
    public function showRegister(Request $request) {
        if (!$request->session()->has('onboarding_passed')) {
            return redirect()->route('onboarding');
        }
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request) {
        // Validasi input
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@student\.ub\.ac\.id$/',
                'unique:users,email'
            ],
            'password' => [
                'required', 
                'min:8', 
                'regex:/[a-z]/',      // minimal 1 lowercase
                'regex:/[A-Z]/',      // minimal 1 uppercase
                'regex:/[@$!%*#?&.,]/', // minimal 1 symbol
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Gunakan email institusi (@student.ub.ac.id).',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan simbol.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Password tidak cocok.',
        ]);

        $email = trim($request->email);

        // Derive name dari email (bagian sebelum @)
        $name = ucfirst(explode('@', $email)[0]);

        $user = User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($request->password),
        ]);

        // Generate dan kirim kode verifikasi
        $this->generateAndSendCode($user);

        // Redirect ke halaman verifikasi
        return redirect()->route('verify', $user->id);
    }

    // Menampilkan Halaman Verifikasi
    public function showVerification(User $user) {
        // Pastikan user belum verified
        if ($user->isVerified()) {
            return redirect()->route('login')->with('success', 'Email sudah diverifikasi. Silakan login.');
        }

        return view('auth.verify', compact('user'));
    }

    // Proses Verifikasi OTP
    public function verify(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required|string|size:6',
        ]);

        $user = User::findOrFail($request->user_id);

        // Cek apakah sudah verified
        if ($user->isVerified()) {
            return redirect()->route('login')->with('success', 'Email sudah diverifikasi.');
        }

        // Cari kode yang valid (belum expired)
        $verification = EmailVerificationCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->latest('created_at')
            ->first();

        if (!$verification) {
            return back()->withErrors([
                'code' => 'Kode verifikasi salah atau sudah kedaluwarsa.',
            ]);
        }

        // Set email sebagai verified
        $user->update(['email_verified_at' => now()]);

        // Hapus semua kode verifikasi user ini
        EmailVerificationCode::where('user_id', $user->id)->delete();

        // Login user secara otomatis
        Auth::login($user, true);

        // Redirect ke dashboard
        return redirect()->route('dashboard')->with('success', 'Akun berhasil diverifikasi. Selamat datang di ULTKSP FILKOM!');
    }

    // Kirim Ulang Kode Verifikasi
    public function resendCode(User $user) {
        // Cek apakah sudah verified
        if ($user->isVerified()) {
            return redirect()->route('login')->with('success', 'Email sudah diverifikasi.');
        }

        // Rate limit: cek apakah kode terakhir dikirim kurang dari 60 detik yang lalu
        $lastCode = EmailVerificationCode::where('user_id', $user->id)
            ->latest('created_at')
            ->first();

        if ($lastCode && $lastCode->created_at->diffInSeconds(now()) < 60) {
            $remaining = 60 - $lastCode->created_at->diffInSeconds(now());
            return back()->withErrors([
                'resend' => "Tunggu {$remaining} detik sebelum meminta kode lainnya.",
            ]);
        }

        // Generate dan kirim kode baru
        $this->generateAndSendCode($user);

        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email kamu.');
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Generate kode OTP 6-digit dan kirim via email.
     */
    private function generateAndSendCode(User $user): void
    {
        // Hapus kode lama
        EmailVerificationCode::where('user_id', $user->id)->delete();

        // Generate kode 6-digit
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan ke database (berlaku 10 menit)
        EmailVerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
            'created_at' => now(),
        ]);

        // Kirim email
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($code, $user->name));
        } catch (\Exception $e) {
            // Jika gagal (sering terjadi di hosting gratis karena blokir SMTP port 587)
            // Simpan kode OTP ke session agar bisa ditampilkan di layar
            session()->flash('fallback_otp', $code);
        }
    }

    /**
     * Validasi kode OTP via AJAX (real-time validation)
     * Mengembalikan status valid, expired, atau tidak cocok
     */
    public function checkCode(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required|string|size:6',
        ]);

        $user = User::findOrFail($request->user_id);

        // Cari kode verifikasi
        $verification = EmailVerificationCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->latest('created_at')
            ->first();

        // Jika kode tidak ada
        if (!$verification) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode verifikasi tidak cocok.',
            ]);
        }

        // Jika kode sudah expired
        if ($verification->isExpired()) {
            return response()->json([
                'valid' => false,
                'expired' => true,
                'message' => 'Kode verifikasi sudah kedaluwarsa. Mohon minta kode baru.',
            ]);
        }

        // Kode valid
        return response()->json([
            'valid' => true,
            'message' => 'Kode verifikasi benar!',
        ]);
    }

    /**
     * Auto-resend kode saat expired
     */
    public function autoResendCode(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        // Cek apakah sudah verified
        if ($user->isVerified()) {
            return response()->json([
                'success' => false,
                'message' => 'Email sudah diverifikasi.',
            ]);
        }

        // Generate dan kirim kode baru
        $this->generateAndSendCode($user);

        return response()->json([
            'success' => true,
            'message' => 'Kode verifikasi baru telah dikirim ke email kamu.',
        ]);
    }

    // ==========================================
    // FORGOT PASSWORD FLOW
    // ==========================================

    public function showForgotPassword() {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar di sistem kami.'
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate and send OTP
        $this->generateAndSendCode($user);

        // Save user ID in session for the next step
        $request->session()->put('reset_user_id', $user->id);

        return redirect()->route('password.verify');
    }

    public function showResetVerify(Request $request) {
        if (!$request->session()->has('reset_user_id')) {
            return redirect()->route('password.request');
        }

        $user = User::find($request->session()->get('reset_user_id'));
        if (!$user) {
            return redirect()->route('password.request');
        }

        return view('auth.forgot-password-verify', compact('user'));
    }

    public function verifyResetCode(Request $request) {
        if (!$request->session()->has('reset_user_id')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $userId = $request->session()->get('reset_user_id');
        $user = User::find($userId);

        $verification = EmailVerificationCode::where('user_id', $userId)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->latest('created_at')
            ->first();

        if (!$verification) {
            return back()->withErrors([
                'code' => 'Kode verifikasi salah atau sudah kedaluwarsa.',
            ]);
        }

        // Clean up OTP codes
        EmailVerificationCode::where('user_id', $userId)->delete();

        // Set flag to allow password reset
        $request->session()->put('reset_password_allowed', true);

        return redirect()->route('password.reset');
    }

    public function showResetPassword(Request $request) {
        if (!$request->session()->has('reset_password_allowed') || !$request->session()->has('reset_user_id')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function updatePassword(Request $request) {
        if (!$request->session()->has('reset_password_allowed') || !$request->session()->has('reset_user_id')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => [
                'required', 
                'min:8', 
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[@$!%*#?&.,]/', 
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan simbol.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Password tidak cocok.',
        ]);

        $userId = $request->session()->get('reset_user_id');
        $user = User::find($userId);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Clear session
        $request->session()->forget(['reset_user_id', 'reset_password_allowed']);

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }
}