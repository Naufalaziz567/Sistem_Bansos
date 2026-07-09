<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{ 
    // 1. Tampilkan Halaman Utama Tabel Warga (Dashboard Petugas)
    public function index()
    {
        $warga = DB::table('warga')->get();
        return view('warga', [
            'title' => 'Data Kependudukan Warga',
            'warga' => $warga
        ]);
    }

    // Dashboard Petugas
public function dashboard()
{
    $totalWarga = DB::table('warga')->count();

    $penerimaAktif = DB::table('bantuan_warga')->count();

    $butuhVerifikasi = DB::table('bantuan_warga')
        ->where('status_penyaluran', 'Proses')
        ->count();

    $sudahDisalurkan = DB::table('bantuan_warga')
        ->where('status_penyaluran', 'Sudah Disalurkan')
        ->count();

    return view('dashboard', [
        'title' => 'Dashboard',
        'totalWarga' => $totalWarga,
        'penerimaAktif' => $penerimaAktif,
        'butuhVerifikasi' => $butuhVerifikasi,
        'sudahDisalurkan' => $sudahDisalurkan
    ]);
}

    // 2. Tampilkan Form Tambah Warga Baru
    public function create()
    {
        return view('warga_create', ['title' => 'Input Biodata Penduduk Baru']);
    }

    // 3. Simpan Data Warga Baru ke Database + Otomatisasi Penentuan Bansos Berbasis Opsi Select
    public function store(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'digits:16', 'unique:warga,nik', 'regex:/^[0-9]+$/'],
            'no_kk' => ['required', 'digits:16', 'regex:/^[0-9]+$/'],
            'nama_lengkap' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'rt_rw' => 'required|string|max:10',
            'pekerjaan' => 'required|string|max:50',
            'penghasilan_per_bulan' => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar di sistem!',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.regex' => 'NIK harus berupa angka penuh tanpa tanda minus (-) atau huruf.',
            'no_kk.digits' => 'No KK harus tepat 16 digit angka.',
            'no_kk.regex' => 'No KK harus berupa angka penuh tanpa tanda minus (-) atau huruf.',
        ]);

        // --- ALGORITMA PENENTUAN OTOMATIS BANSOS (VERSI DROPDOWN) ---
        $penghasilan = $request->penghasilan_per_bulan;
        $tanggungan = $request->jumlah_tanggungan;
        $pekerjaan = strtolower($request->pekerjaan);

        // Kumpulan kata kunci tidak bekerja permanen
        $kunciTidakBekerja = ['nganggur', 'tidak', 'irt', 'rumah tangga', 'belum', 'serabutan'];
        $isTidakBekerja = false;

        foreach ($kunciTidakBekerja as $kunci) {
            if (str_contains($pekerjaan, $kunci)) {
                $isTidakBekerja = true;
                break;
            }
        }

        // Penentuan Jenis Bansos
        if ($penghasilan == 0 || $isTidakBekerja) {
            $jenisBansos = 'BPNT'; // Bantuan Pangan untuk yang tidak berpenghasilan/tetap
        } elseif ($penghasilan <= 1500000 && $tanggungan >= 3) {
            $jenisBansos = 'PKH';  // Penghasilan rendah + tanggungan banyak
        } else {
            $jenisBansos = 'BLT';  // Penghasilan rendah tapi tanggungan sedikit
        }
        // ------------------------------------------------------------

        // Insert ke tabel utama (warga)
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

        $periodeSekarang = date('F Y');
        // Insert otomatis ke tabel monitoring transaksi (bantuan_warga)
        DB::table('bantuan_warga')->insert([
            'nik' => $request->nik,
            'jenis_bansos' => $jenisBansos,
            'periode' => $periodeSekarang,
            'status_penyaluran' => 'Proses',
        ]);

        return redirect('/warga')->with('success', 'Data warga berhasil ditambahkan dan ketetapan bansos berhasil diproses!');
    }

   // 4. Tampilkan Form Edit Warga
public function edit($nik)
{
    $warga = DB::table('warga')
        ->where('nik', $nik)
        ->first();

    if (!$warga) {
        return redirect('/warga')->with('error', 'Data tidak ditemukan.');
    }

    return view('warga_edit', [
        'title' => 'Edit Data Kependudukan',
        'warga' => $warga
    ]);
}
    // 5. Update Data Warga ke Database
    public function update(Request $request, $nik)
    {
        $request->validate([
            'no_kk' => ['required', 'digits:16', 'regex:/^[0-9]+$/'],
            'nama_lengkap' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'rt_rw' => 'required|string|max:10',
            'pekerjaan' => 'required|string|max:50',
            'penghasilan_per_bulan' => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
        ]);

        DB::table('warga')->where('nik', $nik)->update([
            'no_kk' => $request->no_kk,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_lengkap' => $request->alamat_lengkap,
            'rt_rw' => $request->rt_rw,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan_per_bulan' => $request->penghasilan_per_bulan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
        ]);

        return redirect('/warga')->with('success', 'Data warga berhasil diperbarui!');
    }

    // 6. Hapus Data Warga Permanen
    public function destroy($nik)
    {
        DB::table('warga')->where('nik', $nik)->delete();
        return redirect('/warga')->with('success', 'Data warga berhasil dihapus dari sistem!');
    }

    // 7. Tampilkan Halaman Depan Cek Bansos Mandiri Publik
    public function cekBansosMandiri()
    {
        return view('cek_bansos', ['title' => 'Cek Status Penerima Bansos']);
    }

    // 8. Proses Pencarian NIK Warga secara Real-Time via Halaman Depan
    public function prosesCekBansos(Request $request)
    {
        $request->validate(['nik' => 'required|numeric|digits:16']);

        $hasil = DB::table('warga')
            ->join('bantuan_warga', 'warga.nik', '=', 'bantuan_warga.nik')
            ->where('warga.nik', $request->nik)
            ->select('warga.nama_lengkap', 'bantuan_warga.jenis_bansos', 'bantuan_warga.periode', 'bantuan_warga.status_penyaluran')
            ->first();

        return view('cek_bansos', [
            'title' => 'Cek Status Penerima Bansos',
            'hasil' => $hasil,
            'searched' => true,
            'nik' => $request->nik
        ]);
    }

}
