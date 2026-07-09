<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h3 class="text-white text-2xl font-bold tracking-tight">Data Kependudukan Warga</h3>
                <p class="text-gray-400 text-sm mt-1">Kelola data warga untuk validasi bantuan sosial.</p>
            </div>
            <div>
                <a href="{{ route('warga.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-blue-500/20 transition duration-150 flex items-center space-x-2 inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Warga Baru</span>
                </a>
            </div>
        </div>

        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/50 text-gray-400 text-xs font-semibold uppercase tracking-wider border-b border-gray-700">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">NIK / No KK</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Alamat / RT-RW</th>
                            <th class="px-6 py-4">Pekerjaan</th>
                            <th class="px-6 py-4">Penghasilan & Tanggungan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-gray-300 text-sm">
                        @forelse ($warga as $index => $item)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $item->nik }}</div>
                                    <div class="text-xs text-gray-400">KK: {{ $item->no_kk }}</div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-blue-400">{{ $item->nama_lengkap }}</td>
                                <td class="px-6 py-4">
                                    <div>{{ $item->alamat_lengkap }}</div>
                                    <span class="text-xs bg-gray-900 px-2 py-0.5 rounded text-gray-400">RT/RW: {{ $item->rt_rw }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $item->pekerjaan }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-green-400 font-medium">Rp {{ number_format($item->penghasilan_per_bulan, 0, ',', '.') }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->jumlah_tanggungan }} Tanggungan</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('warga.edit', $item->nik) }}" class="px-3 py-1.5 bg-amber-600/20 hover:bg-amber-600 text-amber-400 hover:text-white rounded-lg text-xs font-semibold transition inline-block">Edit</a>
                                        
                                        <form action="{{ route('warga.destroy', $item->nik) }}" method="POST" id="delete-form-{{ $item->nik }}" class="inline">
                                            @csrf
                                            <button type="button" onclick="confirmDelete('{{ $item->nik }}', '{{ $item->nama_lengkap }}')" class="px-3 py-1.5 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white rounded-lg text-xs font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Tidak ada data warga di dalam database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // 1. Alert Pop-up ketika BERHASIL (Tambah/Edit/Hapus)
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#1f2937',     /* Tema gelap menyesuaikan bg-gray-800 */
                color: '#fff',
                confirmButtonColor: '#2563eb', /* Warna Biru Tailwind (blue-600) */
                confirmButtonText: 'Oke, Mantap!'
            });
        @endif

        // 2. Alert Pop-up Konfirmasi Interaktif Sebelum DATA DIHAPUS
        function confirmDelete(nik, nama) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data warga bernama " + nama + " (NIK: " + nik + ") akan dihapus permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#dc2626', /* Merah (red-600) */
                cancelButtonColor: '#4b5563',  /* Abu-abu (gray-600) */
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Eksekusi submit form jika user menekan tombol merah "Ya, Hapus!"
                    document.getElementById('delete-form-' + nik).submit();
                }
            });
        }

    </script>
</x-layout>