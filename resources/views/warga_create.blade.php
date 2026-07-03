<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-2xl border border-gray-700 shadow-xl">
        <h3 class="text-white text-2xl font-bold mb-6">Input Biodata Penduduk Baru</h3>
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-xl text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('warga.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">NIK (16 Digit)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required 
                        inputmode="numeric" pattern="[0-9]{16}" title="NIK harus berupa 16 digit angka penuh"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">No Kartu Keluarga</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk') }}" required 
                        inputmode="numeric" pattern="[0-9]{16}" title="No KK harus berupa 16 digit angka penuh"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-2">
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">Alamat Lengkap</label>
                    <input type="text" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" required class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">RT / RW</label>
                    <input type="text" name="rt_rw" value="{{ old('rt_rw') }}" placeholder="01/02" required class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" required class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">Penghasilan Bulanan</label>
                    <select name="penghasilan_per_bulan" required class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="0" {{ old('penghasilan_per_bulan') == '0' ? 'selected' : '' }}>Tidak Berpenghasilan (Rp 0)</option>
                        <option value="500000" {{ old('penghasilan_per_bulan') == '500000' ? 'selected' : '' }}>< Rp 1.000.000</option>
                        <option value="1250000" {{ old('penghasilan_per_bulan') == '1250000' ? 'selected' : '' }}>Rp 1.000.000 - Rp 1.500.000</option>
                        <option value="2000000" {{ old('penghasilan_per_bulan') == '2000000' ? 'selected' : '' }}>Rp 1.500.001 - Rp 3.000.000</option>
                        <option value="4000000" {{ old('penghasilan_per_bulan') == '4000000' ? 'selected' : '' }}>> Rp 3.000.000</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-400 text-xs font-semibold uppercase mb-2">Jumlah Tanggungan</label>
                    <input type="number" name="jumlah_tanggungan" value="{{ old('jumlah_tanggungan') }}" required 
                        min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : 0"
                        class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="pt-6 flex justify-end space-x-3">
                <a href="/warga" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-xl text-sm font-semibold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition">Simpan Data</button>
            </div>
        </form>
    </div>
</x-layout>