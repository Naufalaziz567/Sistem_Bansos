<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login', ['title' => 'Login Sistem']);
    }

    // Memproses aksi login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari petugas berdasarkan username
        $user = DB::table('petugas')->where('username', $credentials['username'])->first();

        // Cek apakah user ada dan password-nya cocok
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Jika cocok, buat sesi login manual
            session([
                'logged_in' => true, 
                'id_petugas' => $user->id_petugas, 
                'nama' => $user->nama_petugas
            ]);
            
            // PERBAIKAN: Diarahkan langsung ke halaman dashboard setelah sukses!
            return redirect('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
    }

    // Memproses logout
    public function logout()
    {
        // Hapus session login petugas
        session()->forget(['logged_in', 'id_petugas', 'nama']);
        
        // Lempar balik ke halaman login utama dengan pesan sukses
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}