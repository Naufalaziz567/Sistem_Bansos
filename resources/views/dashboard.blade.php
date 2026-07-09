<x-layout>
    <x-slot:title>{{ $title ?? 'Dashboard' }}</x-slot>
    
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-gradient-to-r from-blue-700 to-indigo-800 p-6 rounded-2xl shadow-lg">
            <div>
                <h3 class="text-white text-2xl font-bold tracking-tight">Selamat Datang Kembali, {{ Auth::user()->name ?? 'Petugas' }}!</h3>
                <p class="text-blue-100 text-sm mt-1">Sistem Informasi Penyaluran Bantuan Sosial.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold text-sm rounded-xl shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" /></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php 
                $stats = [
                    ['title' => 'Total Warga', 'value' => $totalWarga ?? 0, 'color' => 'blue', 'unit' => 'Orang'],
                    ['title' => 'Penerima Aktif', 'value' => $penerimaAktif ?? 0, 'color' => 'green', 'unit' => 'KK'],
                    ['title' => 'Dana Tersalurkan', 'value' => $sudahDisalurkan ?? 0, 'color' => 'indigo', 'unit' => 'Bantuan'],
                    ['title' => 'Butuh Verifikasi', 'value' => $butuhVerifikasi ?? 0, 'color' => 'amber', 'unit' => 'Baru']
                ];
            @endphp
            @foreach($stats as $stat)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">{{ $stat['title'] }}</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-1">{{ $stat['value'] }} <span class="text-xs text-gray-400 font-normal">{{ $stat['unit'] }}</span></h4>
                </div>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2">
                <h4 class="text-lg font-bold text-gray-900 mb-6">Tren Realisasi Bansos (2026)</h4>
                <div class="space-y-6">
                    @php
                        $total = ($totalWarga > 0) ? $totalWarga : 1;
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1"><span>Penerima Aktif</span> <span class="font-bold">{{ number_format(($penerimaAktif / $total) * 100, 1) }}%</span></div>
                        <div class="w-full bg-gray-200 rounded-full h-4"><div class="bg-green-600 h-4 rounded-full" style="width: {{ ($penerimaAktif / $total) * 100 }}%"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1"><span>Sudah Disalurkan</span> <span class="font-bold">{{ number_format(($sudahDisalurkan / $total) * 100, 1) }}%</span></div>
                        <div class="w-full bg-gray-200 rounded-full h-4"><div class="bg-indigo-600 h-4 rounded-full" style="width: {{ ($sudahDisalurkan / $total) * 100 }}%"></div></div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h4 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h4>
                <div class="space-y-3">
                    <a href="/warga" class="flex justify-between p-3 bg-gray-50 hover:bg-blue-50 rounded-xl transition group">
                        <span class="text-sm font-medium text-gray-700">Kelola Data Warga</span>
                        <span class="text-gray-400 group-hover:text-blue-600">&rarr;</span>
                    </a>
                    <a href="/reports" class="flex justify-between p-3 bg-gray-50 hover:bg-blue-50 rounded-xl transition group">
                        <span class="text-sm font-medium text-gray-700">Laporan Bulanan</span>
                        <span class="text-gray-400 group-hover:text-blue-600">&rarr;</span>
                    </a>
<<<<<<< Updated upstream
=======
                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 text-xs text-amber-800">
                        <strong>Pemberitahuan:</strong> Sinkronisasi NIK wajib selesai sebelum tanggal 5!
                    </div>
>>>>>>> Stashed changes
                </div>
            </div>
        </div>
    </div>
</x-layout>