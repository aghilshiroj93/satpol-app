{{-- resources/views/perawatan/_form.blade.php --}}
@csrf

@if(isset($perawatan))
    @method('PUT')
@endif

<div class="space-y-6">
    <!-- Barang dan Jenis -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Barang <span class="text-red-500">*</span>
            </label>
            <select name="barang_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('barang_id') border-red-500 @enderror">
                <option value="">Pilih Barang</option>
                @foreach($barang as $item)
                    <option value="{{ $item->id }}" 
                        {{ old('barang_id', $perawatan->barang_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_barang }} - {{ $item->merk }} {{ $item->tipe }}
                        @if($item->kondisi)
                            (Kondisi: {{ $item->kondisi }})
                        @endif
                    </option>
                @endforeach
            </select>
            @error('barang_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Jenis Perawatan <span class="text-red-500">*</span>
            </label>
            <input type="text" name="jenis_perawatan" required
                   value="{{ old('jenis_perawatan', $perawatan->jenis_perawatan ?? '') }}"
                   placeholder="Contoh: Perbaikan mesin, Pembersihan, Kalibrasi"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_perawatan') border-red-500 @enderror">
            @error('jenis_perawatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Deskripsi -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Deskripsi Perawatan <span class="text-red-500">*</span>
        </label>
        <textarea name="deskripsi" rows="3" required
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $perawatan->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tanggal dan Status -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tanggal Perawatan <span class="text-red-500">*</span>
            </label>
            <input type="date" name="tanggal_perawatan" required
                   value="{{ old('tanggal_perawatan', $perawatan->tanggal_perawatan ?? date('Y-m-d')) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_perawatan') border-red-500 @enderror">
            @error('tanggal_perawatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Jadwal Berikutnya
            </label>
            <input type="date" name="jadwal_perawatan_berikutnya"
                   value="{{ old('jadwal_perawatan_berikutnya', $perawatan->jadwal_perawatan_berikutnya ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Status <span class="text-red-500">*</span>
            </label>
            <select name="status" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                <option value="Selesai" {{ old('status', $perawatan->status ?? 'Selesai') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dalam proses" {{ old('status', $perawatan->status ?? '') == 'Dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
                <option value="Terjadwal" {{ old('status', $perawatan->status ?? '') == 'Terjadwal' ? 'selected' : '' }}>Terjadwal</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Biaya (Rp)
            </label>
            <input type="number" name="biaya" min="0" step="1000"
                   value="{{ old('biaya', $perawatan->biaya ?? '') }}"
                   placeholder="0"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('biaya') border-red-500 @enderror">
            @error('biaya')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Teknisi dan Vendor -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nama Teknisi/Petugas
            </label>
            <input type="text" name="teknisi"
                   value="{{ old('teknisi', $perawatan->teknisi ?? '') }}"
                   placeholder="Nama teknisi/petugas"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nama Vendor/Perusahaan
            </label>
            <input type="text" name="vendor"
                   value="{{ old('vendor', $perawatan->vendor ?? '') }}"
                   placeholder="Nama vendor/perusahaan"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <!-- Foto -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Foto Sebelum Perawatan
            </label>
            <input type="file" name="foto_sebelum" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @if(isset($perawatan) && $perawatan->foto_sebelum)
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $perawatan->foto_sebelum) }}" 
                             alt="Foto sebelum" class="w-24 h-24 object-cover rounded-lg border">
                        <a href="{{ asset('storage/' . $perawatan->foto_sebelum) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="ri-external-link-line mr-1"></i> Lihat
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Foto Sesudah Perawatan
            </label>
            <input type="file" name="foto_sesudah" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @if(isset($perawatan) && $perawatan->foto_sesudah)
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $perawatan->foto_sesudah) }}" 
                             alt="Foto sesudah" class="w-24 h-24 object-cover rounded-lg border">
                        <a href="{{ asset('storage/' . $perawatan->foto_sesudah) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="ri-external-link-line mr-1"></i> Lihat
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Catatan -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Catatan Tambahan
        </label>
        <textarea name="catatan" rows="3"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('catatan', $perawatan->catatan ?? '') }}</textarea>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('perawatan.index') }}" 
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg flex items-center">
            <i class="ri-arrow-left-line mr-2"></i> Kembali
        </a>
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg flex items-center">
            <i class="ri-save-line mr-2"></i> Simpan Data
        </button>
    </div>
</div>