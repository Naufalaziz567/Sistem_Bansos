<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WargaController;

// ==========================================
// RUTE AUTHENTICATION (Login, Register, Logout)
// ==========================================

// Dua rute ini sama-sama nampilin form login (Aman dari error GET /login)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);

// Menampilkan Form Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Memproses Aksi Form (Method POST)
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==========================================
// RUTE KONTEN APLIKASI (Setelah Berhasil Login)
// ==========================================

// Dashboard Utama
Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard']);
})->name('dashboard');

// Manajemen Data Kependudukan Warga (Memanggil Controller Resmi)
Route::get('/warga', [WargaController::class, 'index'])->name('warga');

// Laporan Bulanan
Route::get('/reports', function () {
    return view('reports', ['title' => 'Reports Page']);
});

// Welcome Page bawaan
Route::get('/welcome', function () {
    return view('welcome', ['title' => 'Welcome Page']);
});