<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LaporanController;


// ==========================================
// RUTE PUBLIK (Bisa Diakses Warga Tanpa Login)
// ==========================================

// Halaman utama sekarang dialihkan untuk Cek Bansos Mandiri via Web
Route::get('/', [WargaController::class, 'cekBansosMandiri'])->name('cek.bansos');
Route::post('/cek-status', [WargaController::class, 'prosesCekBansos'])->name('cek.proses');


// ==========================================
// RUTE AUTHENTICATION (Login, Register, Logout)
// ==========================================

// Menampilkan Form Login (Dipindah ke /login agar tidak bentrok dengan cek mandiri)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Menampilkan Form Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Memproses Aksi Form Auth (Method POST)
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ==========================================
// RUTE KONTEN APLIKASI PETUGAS (Setelah Berhasil Login)
// ==========================================

// 1. Dashboard Utama Petugas
Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');

// 2. Manajemen Data Kependudukan Warga (CRUD Lengkap)
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga/store', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{nik}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::post('/warga/{nik}/update', [WargaController::class, 'update'])->name('warga.update');
Route::post('/warga/{nik}/delete', [WargaController::class, 'destroy'])->name('warga.destroy');

// 3. Monitoring & Laporan Realisasi Penyaluran Bansos
Route::get('/reports', [LaporanController::class, 'reportView'])->name('reports.view');
Route::put('/reports/update/{id}', [LaporanController::class, 'updateStatus'])->name('reports.update');
