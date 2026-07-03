<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="max-w-2xl mx-auto bg-gray-800 p-6 rounded-2xl border border-gray-700 shadow-xl">
        <h3 class="text-white text-xl font-bold mb-4">Edit Data Penduduk</h3>
        
        <form action="{{ route('warga.update', $warga->nik) }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 text-xs font-semibold uppercase mb-1">NIK (Tidak Bisa Diubah)</label>
                    <input type="text"
       name="nik"
       value="{{ $warga->nik }}"
       readonly
       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-xl text-gray-400 text-sm outline-none">
                </div>
                <div>
                    <label class="block text-gray-600 text-xs font-semibold uppercase mb-1">No KK (Tidak Bisa Diubah)</label>
                    <input type="text"
       name="no_kk"
       value="{{ $warga->no_kk }}"
       readonly
       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-xl text-gray-400 text-sm outline-none">
                </div>
            </div>
            <div>
                <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ $warga->nama_lengkap }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">Alamat Lengkap</label>
                    <input type="text" name="alamat_lengkap" value="{{ $warga->alamat_lengkap }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">RT / RW</label>
                    <input type="text" name="rt_rw" value="{{ $warga->rt_rw }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ $warga->pekerjaan }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">Penghasilan Bulanan</label>
                    <input type="number" name="penghasilan_per_bulan" value="{{ $warga->penghasilan_per_bulan }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-1">Jumlah Tanggungan</label>
                    <input type="number" name="jumlah_tanggungan" value="{{ $warga->jumlah_tanggungan }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="pt-4 flex justify-end space-x-2">
                <a href="/warga" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-xl text-sm font-semibold transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-semibold transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layout>