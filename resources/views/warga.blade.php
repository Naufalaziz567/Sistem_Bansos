<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-white text-2xl font-bold tracking-tight">Data Kependudukan Warga</h3>
                <p class="text-gray-400 text-sm mt-1">Kelola data warga untuk validasi bantuan sosial.</p>
            </div>
            <a href="{{ route('warga.create') }}" class="group bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-blue-900/30 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                <span>Tambah Warga Baru</span>
            </a>
        </div>

<<<<<<< Updated upstream
        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
=======
        <div class="relative">
            <input type="text" placeholder="Cari berdasarkan NIK atau Nama..." 
                class="w-full pl-12 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-2xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <div class="bg-gray-800 rounded-3xl border border-gray-700 overflow-hidden shadow-2xl">
>>>>>>> Stashed changes
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 text-gray-400 text-xs uppercase tracking-widest border-b border-gray-700">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">NIK / No KK</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4">Pekerjaan</th>
                            <th class="px-6 py-4">Penghasilan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50 text-sm">
                        @forelse ($warga as $index => $item)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-5 text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-gray-100">{{ $item->nik }}</div>
                                    <div class="text-[11px] text-blue-400">KK: {{ $item->no_kk }}</div>
                                </td>
                                <td class="px-6 py-5 font-semibold text-white">{{ $item->nama_lengkap }}</td>
                                <td class="px-6 py-5 text-gray-300">
                                    <div>{{ $item->alamat_lengkap }}</div>
                                    <span class="text-[10px] bg-gray-900 px-2 py-0.5 rounded text-gray-500 mt-1 inline-block">RT/RW: {{ $item->rt_rw }}</span>
                                </td>
                                <td class="px-6 py-5 text-gray-300">{{ $item->pekerjaan }}</td>
                                <td class="px-6 py-5">
                                    <div class="text-emerald-400 font-bold">Rp {{ number_format($item->penghasilan_per_bulan, 0, ',', '.') }}</div>
                                    <div class="text-[11px] text-gray-500">{{ $item->jumlah_tanggungan }} Tanggungan</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('warga.edit', $item->nik) }}" class="px-3 py-1.5 bg-gray-700 hover:bg-amber-600 text-white rounded-lg text-xs font-semibold transition">Edit</a>
                                        <form action="{{ route('warga.destroy', $item->nik) }}" method="POST" id="delete-form-{{ $item->nik }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $item->nik }}', '{{ $item->nama_lengkap }}')" class="px-3 py-1.5 bg-red-900/30 hover:bg-red-600 text-red-400 hover:text-white rounded-lg text-xs font-semibold transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                       @empty
    <tr>
        <td colspan="6" class="px-6 py-16 text-center">
            <div class="flex flex-col items-center justify-center text-gray-500">
                <svg class="w-12 h-12 mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-medium text-lg">Data tidak ditemukan</p>
                <p class="text-sm">Silakan periksa kembali kata kunci pencarian Anda.</p>
                <a href="{{ route('warga.index') }}" class="mt-4 text-blue-400 hover:underline">Reset Pencarian</a>
            </div>
        </td>
    </tr>
@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(nik, nama) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data " + nama + " akan dihapus permanen!",
                icon: 'warning',
                background: '#1f2937',
                color: '#fff',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('delete-form-' + nik).submit();
            });
        }

    </script>
</x-layout>