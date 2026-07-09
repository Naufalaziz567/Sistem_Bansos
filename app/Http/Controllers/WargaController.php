<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{ 
    // 1. Tampilkan Halaman Utama Tabel Warga (Dengan Fitur Pencarian)
    public function index(Request $request)
    {
        $query = DB::table('warga');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
        }

        $warga = $query->get();

        return view('warga', [
            'title' => 'Data Kependudukan Warga',
            'warga' => $warga
        ]);
    }

    // 2. Dashboard Petugas
    public function dashboard()
    {
        $totalWarga = DB::table('warga')->count();
        $penerimaAktif = DB::table('bantuan_warga')->count();
        $butuhVerifikasi = DB::table('bantuan_warga')->where('status_penyaluran', 'Proses')->count();
        $sudahDisalurkan = DB::table('bantuan_warga')->where('status_penyaluran', 'Sudah Disalurkan')->count();

        return view('dashboard', [
            'title' => 'Dashboard',
            'totalWarga' => $totalWarga,
            'penerimaAktif' => $penerimaAktif,
            'butuhVerifikasi' => $butuhVerifikasi,
            'sudahDisalurkan' => $sudahDisalurkan
        ]);
    }

    // 3. Tampilkan Form Tambah
    public function create()
    {
        return view('warga_create', ['title' => 'Input Biodata Penduduk Baru']);
    }

    // 4. Simpan Data Warga
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:warga,nik',
            'no_kk' => 'required|digits:16',
            'nama_lengkap' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'rt_rw' => 'required|string|max:10',
            'pekerjaan' => 'required|string|max:50',
            'penghasilan_per_bulan' => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
        ]);

        $jenisBansos = ($request->penghasilan_per_bulan == 0) ? 'BPNT' : 'BLT';

        DB::table('warga')->insert([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'rt_rw' => $request->rt_rw,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan_per_bulan' => $request->penghasilan_per_bulan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
        ]);

<<<<<<< Updated upstream
        $periodeSekarang = date('F Y');
        // Insert otomatis ke tabel monitoring transaksi (bantuan_warga)
=======
>>>>>>> Stashed changes
        DB::table('bantuan_warga')->insert([
            'nik' => $request->nik,
            'jenis_bansos' => $jenisBansos,
            'periode' => $periodeSekarang,
            'status_penyaluran' => 'Proses',
        ]);

        return redirect('/warga')->with('success', 'Data berhasil ditambahkan!');
    }

<<<<<<< Updated upstream
   // 4. Tampilkan Form Edit Warga
public function edit($nik)
{
    $warga = DB::table('warga')
        ->where('nik', $nik)
        ->first();

    if (!$warga) {
        return redirect('/warga')->with('error', 'Data tidak ditemukan.');
=======
    // 5. Edit Data
    public function edit($nik)
    {
        $warga = DB::table('warga')->where('nik', $nik)->first();
        return view('warga_edit', ['title' => 'Edit Data', 'warga' => $warga]);
>>>>>>> Stashed changes
    }

    // 6. Update Data
    public function update(Request $request, $nik)
    {
        DB::table('warga')->where('nik', $nik)->update($request->except(['_token', '_method']));
        return redirect('/warga')->with('success', 'Data berhasil diperbarui!');
    }

    // 7. Hapus Data
    public function destroy($nik)
    {
        DB::table('warga')->where('nik', $nik)->delete();
        return redirect('/warga')->with('success', 'Data berhasil dihapus!');
    }

    // 8. Cek Bansos Mandiri
    public function cekBansosMandiri()
    {
        return view('cek_bansos', ['title' => 'Cek Status Penerima Bansos']);
    }

    // 9. Proses Cek Bansos
    public function prosesCekBansos(Request $request)
    {
        $hasil = DB::table('warga')
            ->join('bantuan_warga', 'warga.nik', '=', 'bantuan_warga.nik')
            ->where('warga.nik', $request->nik)
            ->first();

        return view('cek_bansos', ['hasil' => $hasil, 'searched' => true]);
    }

<<<<<<< Updated upstream
}
=======
    // 10. Laporan
    public function reportIndex()
    {
        return view('reports', [
            'title' => 'Laporan Bansos',
            'laporan' => DB::table('bantuan_warga')->join('warga', 'bantuan_warga.nik', '=', 'warga.nik')->get()
        ]);
    }
}
>>>>>>> Stashed changes
