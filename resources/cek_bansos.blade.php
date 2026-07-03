<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Monitoring Bansos Mandiri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex items-center justify-center bg-slate-950 p-4">

    <div class="w-full max-w-md bg-gray-800 border border-gray-700 p-6 rounded-3xl shadow-2xl">
        <div class="text-center mb-6">
            <span class="text-3xl">🏛️</span>
            <h2 class="text-white text-xl font-bold mt-2">Cek Penerima Bansos Mandiri</h2>
            <p class="text-gray-400 text-xs mt-1">Masukkan NIK 16 digit Anda untuk memonitor status bantuan</p>
        </div>

        <form action="{{ route('cek.proses') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="nik" placeholder="Masukkan NIK Anda..." required maxlength="16"
                    value="{{ $nik ?? '' }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white text-center text-sm font-bold tracking-widest focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-sm transition">
                Cari Data Bantuan
            </button>
        </form>

        @if(isset($searched))
            <div class="mt-6 border-t border-gray-700 pt-4 space-y-3">
                @if($hasil)
                    <div class="p-4 bg-blue-900/20 border border-blue-800 rounded-2xl">
                        <p class="text-xs text-gray-400">Nama Penerima:</p>
                        <h4 class="text-white font-bold text-base mb-2">{{ $hasil->nama_lengkap }}</h4>
                        
                        <div class="flex justify-between text-xs py-1 border-b border-gray-700/50">
                            <span class="text-gray-400">Program Bansos:</span>
                            <span class="text-blue-400 font-bold">{{ $hasil->jenis_bansos }}</span>
                        </div>
                        <div class="flex justify-between text-xs py-1 border-b border-gray-700/50">
                            <span class="text-gray-400">Periode Salur:</span>
                            <span class="text-gray-200">{{ $hasil->periode }}</span>
                        </div>
                        <div class="flex justify-between text-xs pt-1.5 items-center">
                            <span class="text-gray-400">Status Terkini:</span>
                            @if($hasil->status_penyaluran == 'Sudah Disalurkan')
                                <span class="text-green-400 font-bold text-xs bg-green-900/30 px-2 py-0.5 rounded border border-green-800">✅ Selesai Cair</span>
                            @else
                                <span class="text-amber-400 font-bold text-xs bg-amber-900/30 px-2 py-0.5 rounded border border-amber-800">⏳ Proses Distribusi</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="p-4 bg-red-900/20 border border-red-800 text-red-300 text-center rounded-2xl text-xs">
                        ❌ NIK Anda tidak terdaftar sebagai penerima manfaat bansos (PKH/BLT/BPNT) untuk periode berjalan ini.
                    </div>
                @endif
            </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-gray-300 transition underline">Login Petugas Desa →</a>
        </div>
    </div>

</body>
</html>