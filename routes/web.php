<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\Profile;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Rute Tampilan Form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Rute Eksekusi Proses Aksi (POST)
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Page']);
});

Route::get('/profile', function () {
    return view('profile', ['title' => 'Profile Page', 'profile' => Profile::first()]);
});

Route::get('/reports', function () {
    return view('reports', ['title' => 'Reports Page']);
});


