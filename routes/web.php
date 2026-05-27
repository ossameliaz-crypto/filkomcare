<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

// Guest Routes (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    // Onboarding — landing page pertama kali
    Route::get('/', [AuthController::class, 'landing'])->name('landing');
    Route::get('/onboarding', [AuthController::class, 'showOnboarding'])->name('onboarding');

    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Verification Routes
    Route::get('/verify/{user}', [AuthController::class, 'showVerification'])->name('verify');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verify.submit');
    Route::post('/verify/resend/{user}', [AuthController::class, 'resendCode'])->name('verify.resend');
});

// Protected Routes (Hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/konsultasi', [ConsultationController::class, 'store'])->name('consultation.store');
    Route::get('/konsultasi/detail', [ConsultationController::class, 'detail'])->name('consultation.detail');
    
    Route::get('/riwayat', [ConsultationController::class, 'history'])->name('history.index');
    Route::get('/riwayat/{id}', [ConsultationController::class, 'showHistory'])->name('history.show');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});