<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Rute untuk halaman login
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);

// Rute untuk proses logout
Route::post('/filament/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('filament.admin.auth.logout');

// Rute untuk menampilkan formulir permintaan reset password
Route::get('/password/request', [PasswordResetLinkController::class, 'create'])->name('password.request');

// Rute untuk mengirimkan link reset password
Route::post('/password/email', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Rute untuk menampilkan formulir untuk mengatur password baru
Route::get('/password/reset/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

// Rute untuk memproses pengaturan password baru
Route::post('/password/reset', [NewPasswordController::class, 'store'])->name('password.update');

Route::get('/', function () {
    return view('welcome');
});
