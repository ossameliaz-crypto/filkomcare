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
            'nim.required' => 'E-09: Kolom NIM wajib diisi.', // [cite: 408]
            'password.required' => 'E-09: Kolom Password wajib diisi.', // [cite: 408]
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
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, kembalikan pesan error sesuai kode E-02 SRS [cite: 406]
        return back()->withErrors([
            'login_error' => 'E-02: NIM atau kata sandi tidak valid. Silakan coba lagi.',
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
            'identifier' => 'required',
            'password' => [
                'required', 
                'min:8', 
                'regex:/[a-z]/',      // minimal 1 lowercase
                'regex:/[A-Z]/',      // minimal 1 uppercase
                'regex:/[@$!%*#?&.,]/', // minimal 1 symbol
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'identifier.required' => 'Kolom NIM atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan simbol.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Password tidak cocok.',
        ]);

        $identifier = trim($request->identifier);
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            // Validasi format email UB [cite: 422]
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@student\.ub\.ac\.id$/', $identifier)) {
                return back()->withErrors([
                    'identifier' => 'Gunakan email institusi (@student.ub.ac.id).',
                ])->withInput();
            }

            // Cek email unik
            if (User::where('email', $identifier)->exists()) {
                return back()->withErrors([
                    'identifier' => 'Email sudah terdaftar.',
                ])->withInput();
            }

            // Derive name dari email (bagian sebelum @)
            $name = ucfirst(explode('@', $identifier)[0]);

            $user = User::create([
                'email' => $identifier,
                'name' => $name,
                'password' => Hash::make($request->password),
            ]);
        } else {
            // Validasi NIM: harus 18 digit angka [cite: 422]
            if (!preg_match('/^\d{18}$/', $identifier)) {
                return back()->withErrors([
                    'identifier' => 'NIM harus terdiri dari 18 digit angka.',
                ])->withInput();
            }

            // Cek NIM unik
            if (User::where('nim', $identifier)->exists()) {
                return back()->withErrors([
                    'identifier' => 'NIM sudah terdaftar.',
                ])->withInput();
            }

            // Buat email dari NIM: nim@student.ub.ac.id
            $email = $identifier . '@student.ub.ac.id';
            $name = 'Mahasiswa ' . $identifier;

            $user = User::create([
                'nim' => $identifier,
                'email' => $email,
                'name' => $name,
                'password' => Hash::make($request->password),
            ]);
        }

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
}