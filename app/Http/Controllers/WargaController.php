<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data dari tabel warga secara riil
        $dataWarga = DB::table('warga')->get();

        // Kirim data ke view warga.blade.php
        return view('warga', [
            'title' => 'Data Kependudukan Warga',
            'warga' => $dataWarga
        ]);
    }
}