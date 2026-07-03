<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-white text-2xl font-bold tracking-tight">Laporan Realisasi Bansos</h3>
                <p class="text-gray-400 text-sm mt-1">Monitoring status penyaluran bansos per periode aktif desa.</p>
            </div>
            <div>
                <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-emerald-500/20 transition duration-150 flex items-center space-x-2">
                    <span>🖨️ Cetak Laporan (PDF)</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-800 p-5 rounded-2xl border border-gray-700">
                <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Total Alokasi Penerima</p>
                <h3 class="text-white text-2xl font-bold mt-2">{{ $totalPenerima }} KPM (Warga)</h3>
            </div>
            <div class="bg-gray-800 p-5 rounded-2xl border border-gray-700">
                <p class="text-green-400 text-xs font-semibold uppercase tracking-wider">Sukses Disalurkan</p>
                <h3 class="text-green-400 text-2xl font-bold mt-2">{{ $totalDisalurkan }} KPM</h3>
            </div>
            <div class="bg-gray-800 p-5 rounded-2xl border border-gray-700">
                <p class="text-amber-400 text-xs font-semibold uppercase tracking-wider">Dalam Proses Salur</p>
                <h3 class="text-amber-400 text-2xl font-bold mt-2">{{ $totalProses }} KPM</h3>
            </div>
        </div>

        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 text-gray-400 text-xs font-semibold uppercase tracking-wider border-b border-gray-700">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Penerima / NIK</th>
                            <th class="px-6 py-4">Wilayah (RT/RW)</th>
                            <th class="px-6 py-4">Jenis Bansos</th>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4 text-center">Status Monitoring</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-gray-300 text-sm">
                        @forelse ($laporan as $index => $item)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $item->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-400">NIK: {{ $item->nik }}</div>
                                </td>
                                <td class="px-6 py-4">RT/RW: {{ $item->rt_rw }}</td>
                                <td class="px-6 py-4 font-semibold text-blue-400">{{ $item->jenis_bansos }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $item->periode }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($item->status_penyaluran == 'Sudah Disalurkan')
                                        <span class="px-2.5 py-1 bg-green-900/40 text-green-400 border border-green-800 rounded-full text-xs font-semibold">Sudah Disalurkan</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-amber-900/40 text-amber-400 border border-amber-800 rounded-full text-xs font-semibold">Dalam Proses</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada rekaman monitoring bansos untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>