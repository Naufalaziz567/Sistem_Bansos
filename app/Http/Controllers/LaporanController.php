<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBansos; 

class LaporanController extends Controller
{
    // Method untuk menampilkan view laporan
    public function reportView(Request $request) 
    {
        $title = "Laporan Penyaluran Bansos";
        
        $query = LaporanBansos::with('warga');

        $daftarPeriode = [];
        for ($i = 0; $i < 12; $i++) {
            $daftarPeriode[] = \Carbon\Carbon::now()->addMonths($i)->translatedFormat('F Y');
        }

        // Logika filter (akan otomatis memproses URL seperti: /data-desa/laporan-bansos?periode=Juni+2026)
        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        $laporan = $query->get();

        $totalPenerima = $laporan->count();
        $totalDisalurkan = $laporan->where('status_penyaluran', 'Sudah Disalurkan')->count();
        $totalProses = $laporan->where('status_penyaluran', 'Proses')->count();

        return view('reports', compact('laporan', 'totalPenerima', 'totalDisalurkan', 'totalProses', 'title', 'daftarPeriode'));
    }

    // Method khusus untuk update via tombol simpan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'jenis_bansos' => 'required|string',
            'status_penyaluran' => 'required|string',
        ]);

        $item = LaporanBansos::findOrFail($id);
        $item->jenis_bansos = $request->jenis_bansos;
        $item->status_penyaluran = $request->status_penyaluran;
        $item->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}
