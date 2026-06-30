<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form register
    public function showRegistrationForm()
    {
        return view('register', ['title' => 'Register Petugas']);
    }

    // Memproses data pendaftaran
    public function register(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:petugas,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Insert menggunakan Query Builder biasa sesuai tabel kamu
        DB::table('petugas')->insert([
            'nama_petugas' => $request->nama_petugas,
            'jabatan' => $request->jabatan ?? 'Petugas Lapangan',
            'username' => $request->username,
            'password' => Hash::make($request->password), // Enkripsi password aman
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}