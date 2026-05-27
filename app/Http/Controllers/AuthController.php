<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLogin() {
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

        if (Auth::attempt([$fieldType => $request->nim, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, kembalikan pesan error sesuai kode E-02 SRS [cite: 406]
        return back()->withErrors([
            'login_error' => 'E-02: NIM atau kata sandi tidak valid. Silakan coba lagi.',
        ])->withInput($request->only('nim'));
    }

    // Menampilkan Halaman Register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request) {
        $request->validate([
            'nim' => 'required|numeric|digits:18|unique:users,nim', // Aturan validasi SRS [cite: 422]
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@student\.ub\.ac\.id$/|unique:users,email', // Harus email UB [cite: 422]
            'password' => 'required|min:8', // Minimal 8 karakter [cite: 422]
            'password_confirmation' => 'required|same:password', // Harus cocok [cite: 422]
        ], [
            'nim.digits' => 'NIM harus terdiri dari 18 digit angka.', // [cite: 422]
            'email.regex' => 'Gunakan email institusi (@student.ub.ac.id).', // [cite: 422]
            'password.min' => 'Password minimal 8 karakter.', // [cite: 422]
            'password_confirmation.same' => 'Password tidak cocok.', // [cite: 422]
        ]);

        // Simpan User Baru ke Database
        User::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // [cite: 413]
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Selamat datang di ULTKSP FILKOM!');
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}