<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gradient-to-r from-blue-700 to-indigo-800 p-6 rounded-2xl shadow-lg">
            <div>
                <h3 class="text-white text-2xl font-bold tracking-tight">Selamat Datang Kembali, {{ Auth::user()->name ?? 'petugas' }}!</h3>
                <p class="text-blue-100 text-sm mt-1">Sistem Informasi Penyaluran Bantuan Sosial.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold text-sm rounded-xl shadow-md transition duration-150 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <span>Logout dari Sistem</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-2.533-4.65l-1.21-.396M15 19.128v-3.322c0-1.272.578-2.478 1.57-3.211A5.25 5.25 0 0 0 17.5 3a5.25 5.25 0 0 0-2.5 4.757m0 11.371a9.349 9.349 0 0 1-5.147-1.545M15 19.128v-3.322c0-1.272-.578-2.478-1.57-3.211A5.25 5.25 0 0 0 13.5 3A5.25 5.25 0 0 0 8.5 7.757m0 11.371a9.333 9.333 0 0 1-5.147-1.545M8.5 19.128v-3.322c0-1.272.578-2.478 1.57-3.211A5.25 5.25 0 0 0 10.5 3A5.25 5.25 0 0 0 5.5 7.757m0 11.371C3.615 18.062 2.25 16.19 2.25 14c0-2.207 1.35-4.08 3.235-4.871" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Data Warga</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">{{ $totalWarga }}</h4>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Penerima Aktif</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">
    {{ $penerimaAktif }}
    <span class="text-xs text-gray-400 font-normal">KK</span>
</h4>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125H3M16.5 9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Dana Tersalurkan</p>
                    <h4 class="text-xl font-bold text-gray-900 mt-1">
    {{ $sudahDisalurkan }} Bantuan
</h4>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Butuh Verifikasi</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">
    {{ $butuhVerifikasi }}
    <span class="text-xs text-amber-500 font-normal">Baru</span>
</h4>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-gray-900">Tren Realisasi Bansos (2026)</h4>
                    <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg">Pembaruan Otomatis</span>
                </div>
               <div class="h-64 bg-gray-50 rounded-xl p-6">
    <div class="space-y-4">

        <div>   
            <p class="text-sm font-medium">Total Warga</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-blue-600 h-4 rounded-full" style="width:100%"></div>
            </div>
            <p class="text-sm mt-1">{{ $totalWarga }} Orang</p>
        </div>

        <div>
            <p class="text-sm font-medium">Penerima Aktif</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-green-600 h-4 rounded-full" style="width:80%"></div>
            </div>
            <p class="text-sm mt-1">{{ $penerimaAktif }} KK</p>
        </div>

        <div>
            <p class="text-sm font-medium">Sudah Disalurkan</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-indigo-600 h-4 rounded-full" style="width:60%"></div>
            </div>
            <p class="text-sm mt-1">{{ $sudahDisalurkan }} Bantuan</p>
        </div>

    </div>
</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h4 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat Petugas</h4>
                <div class="space-y-3">
                    <a href="/warga" class="flex items-center justify-between p-3 bg-gray-50 hover:bg-blue-50 text-gray-700 hover:text-blue-700 rounded-xl transition duration-150 group">
                        <span class="text-sm font-medium">Kelola Data Kependudukan</span>
                        <span class="text-gray-400 group-hover:text-blue-500">&rarr;</span>
                    </a>
                    <a href="/reports" class="flex items-center justify-between p-3 bg-gray-50 hover:bg-blue-50 text-gray-700 hover:text-blue-700 rounded-xl transition duration-150 group">
                        <span class="text-sm font-medium">Buat Laporan Bulanan</span>
                        <span class="text-gray-400 group-hover:text-blue-500">&rarr;</span>
                    </a>
                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 text-xs text-amber-800">
                        <strong>Pemberitahuan:</strong> Pastikan sinkronisasi NIK warga selesai sebelum tanggal 5 bulan depan ya, Bro!
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>