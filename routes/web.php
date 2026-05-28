<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

// Webhook Route untuk Google Sheets
Route::post('/webhook/update-status', [ConsultationController::class, 'updateStatus']);

// Guest Routes (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    // Onboarding — landing page pertama kali
    Route::get('/', [AuthController::class, 'landing'])->name('landing');
    Route::get('/onboarding', [AuthController::class, 'showOnboarding'])->name('onboarding');
    Route::get('/onboarding-complete', [AuthController::class, 'completeOnboarding'])->name('onboarding.complete');

    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Verification Routes
    Route::get('/verify/{user}', [AuthController::class, 'showVerification'])->name('verify');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verify.submit');
    Route::post('/verify/resend/{user}', [AuthController::class, 'resendCode'])->name('verify.resend');
    Route::post('/verify/check-code', [AuthController::class, 'checkCode'])->name('verify.checkCode');
    Route::post('/verify/auto-resend', [AuthController::class, 'autoResendCode'])->name('verify.autoResend');
});

// Protected Routes (Hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Cek notifikasi konsultasi hari ini
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $consultations = \App\Models\Consultation::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('date', $today)
            ->whereIn('status', ['pending', 'approved', 'Menunggu', 'Diproses'])
            ->get();
            
        foreach ($consultations as $c) {
            $notifTitle = 'Sesi Konseling Hari Ini';
            // Cek apakah sudah ada notifikasi serupa hari ini
            $exists = \App\Models\Notification::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('title', $notifTitle)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->exists();
                
            if (!$exists) {
                \App\Models\Notification::create([
                    'user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'title' => $notifTitle,
                    'message' => 'Anda memiliki sesi konseling hari ini jam ' . $c->time . '. Pastikan Anda hadir tepat waktu. Silakan cek detail di menu Konsultasi.',
                    'type' => 'reminder'
                ]);
            }
        }
        
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/konsultasi', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/konsultasi', [ConsultationController::class, 'store'])->name('consultation.store');
    Route::get('/konsultasi/detail', [ConsultationController::class, 'detail'])->name('consultation.detail');
    
    // SOS / Panic Button
    Route::post('/sos', [ConsultationController::class, 'sos'])->name('sos.submit');
    
    Route::get('/riwayat', [ConsultationController::class, 'history'])->name('history.index');
    Route::get('/riwayat/{id}', [ConsultationController::class, 'showHistory'])->name('history.show');
    
    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Profile Sub-pages
    Route::get('/profile/privacy', [App\Http\Controllers\ProfileController::class, 'privacy'])->name('profile.privacy');
    Route::get('/profile/notifications', [App\Http\Controllers\ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::get('/profile/faq', [App\Http\Controllers\ProfileController::class, 'faq'])->name('profile.faq');
    Route::get('/profile/settings', [App\Http\Controllers\ProfileController::class, 'settings'])->name('profile.settings');
    Route::post('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::post('/profile/delete-account', [App\Http\Controllers\ProfileController::class, 'deleteAccount'])->name('profile.deleteAccount');
    
    // Notification Routes
    Route::get('/notifikasi', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifikasi/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::post('/notifikasi/{id}/mark-read', [App\Http\Controllers\NotificationController::class, 'markRead'])->name('notifications.markRead');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});