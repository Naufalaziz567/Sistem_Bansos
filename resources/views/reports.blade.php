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

        <div class="bg-gray-800 p-4 rounded-2xl border border-gray-700 flex items-center gap-4">
            <form action="{{ request()->url() }}" method="GET" class="flex items-center gap-3 w-full sm:w-auto">
                <label for="periode" class="text-sm text-gray-400 font-semibold">Filter Periode:</label>
                <select name="periode" id="periode" onchange="this.form.submit()" class="bg-gray-900 text-white border border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500 cursor-pointer">
                    <option value="">Semua Periode</option>
                    @foreach($daftarPeriode as $p)
                        <option value="{{ $p }}" {{ request('periode') == $p ? 'selected' : '' }}>
                            {{ $p }}
                        </option>
                    @endforeach
                </select>
                @if(request('periode'))
                    <a href="{{ request()->url() }}" class="text-gray-400 hover:text-white text-sm transition ml-2">Reset Filter</a>
                @endif
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-900/40 border border-green-800 text-green-400 p-4 rounded-xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

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
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-gray-300 text-sm">
                        @forelse ($laporan as $index => $item)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $item->warga->nama_lengkap ?? 'Nama Tidak Ditemukan' }}</div>
                                    <div class="text-xs text-gray-400">NIK: {{ $item->nik }}</div>
                                </td>
                                
                                <td class="px-6 py-4 text-gray-400 whitespace-nowrap">
                                    RT/RW: {{ $item->warga->rt_rw ?? '-' }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <select name="jenis_bansos" form="form-{{ $item->id }}" class="bg-gray-900 text-blue-400 border border-gray-700 rounded px-2 py-1 text-sm font-semibold focus:outline-none focus:border-blue-500 w-full cursor-pointer">
                                        <option value="PKH" {{ $item->jenis_bansos == 'PKH' ? 'selected' : '' }}>PKH</option>
                                        <option value="BLT" {{ $item->jenis_bansos == 'BLT' ? 'selected' : '' }}>BLT</option>
                                        <option value="BPNT" {{ $item->jenis_bansos == 'BPNT' ? 'selected' : '' }}>BPNT</option>
                                    </select>
                                </td>
                                
                                <td class="px-6 py-4 text-gray-400 whitespace-nowrap">{{ $item->periode }}</td>
                                
                                <td class="px-6 py-4 text-center">
                                    <select name="status_penyaluran" form="form-{{ $item->id }}" class="bg-gray-900 border border-gray-700 rounded px-2 py-1 text-xs font-semibold focus:outline-none focus:border-blue-500 w-full cursor-pointer
                                        {{ $item->status_penyaluran == 'Sudah Disalurkan' ? 'text-green-400' : 'text-amber-400' }}">
                                        <option value="Sudah Disalurkan" {{ $item->status_penyaluran == 'Sudah Disalurkan' ? 'selected' : '' }}>Sudah Disalurkan</option>
                                        <option value="Proses" {{ $item->status_penyaluran == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    </select>
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    <form id="form-{{ $item->id }}" action="{{ route('reports.update', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-blue-600/20 text-blue-400 border border-blue-600/50 hover:bg-blue-600 hover:text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">Belum ada rekaman monitoring bansos untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>