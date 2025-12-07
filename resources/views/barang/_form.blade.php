<form action="{{ $action }}" method="POST" class="space-y-8">
    @csrf
    @if ($method == 'PUT')
        @method('PUT')
    @endif

    <!-- Header -->
    <div class="pb-4 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $method == 'PUT' ? 'Edit Barang' : 'Tambah Barang Baru' }}
        </h2>
        <p class="text-gray-600 mt-1">Isi data barang dengan lengkap dan benar</p>
    </div>

    <!-- Kode Aset & Identitas -->
    <div class="space-y-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Kode Aset</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach (['kd_aset1', 'kd_aset2', 'kd_aset3', 'kd_aset4', 'kd_aset5'] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ str_replace('kd_aset', 'Aset ', $field) }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="{{ $field }}"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            value="{{ old($field, $barang->{$field} ?? '') }}" required>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Barang</label>
                <input type="text" name="kode_barang"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('kode_barang', $barang->kode_barang ?? '') }}"
                    placeholder="(opsional) kode lengkap / gabungan kd_aset">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">NIBAR</label>
                <input type="text" name="nibar"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('nibar', $barang->nibar ?? '') }}" placeholder="Nomor inventaris (opsional)">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">REG</label>
                <input type="text" name="reg"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('reg', $barang->reg ?? '') }}" placeholder="Nomor REG (opsional)">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                Nama Barang <span class="text-red-500">*</span>
            </label>
            <input type="text" name="nama_barang"
                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
        </div>
    </div>

    <!-- Informasi Detail (dua kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah <span
                        class="text-red-500">*</span></label>
                <input type="number" name="jumlah"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('jumlah', $barang->jumlah ?? '') }}" required min="1">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Satuan</label>
                <input type="text" name="satuan"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('satuan', $barang->satuan ?? '') }}" placeholder="Contoh: unit / buah / paket">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Spesifikasi (singkat)</label>
                <input type="text" name="spesifikasi_nama"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('spesifikasi_nama', $barang->spesifikasi_nama ?? '') }}"
                    placeholder="Contoh: 16GB, Stainless, dll">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Spesifikasi (detail)</label>
                <textarea name="spesifikasi_lain" rows="3"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">{{ old('spesifikasi_lain', $barang->spesifikasi_lain ?? '') }}</textarea>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Merk</label>
                <input type="text" name="merk"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('merk', $barang->merk ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tipe</label>
                <input type="text" name="tipe"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('tipe', $barang->tipe ?? '') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Polisi</label>
                <input type="text" name="nopol"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('nopol', $barang->nopol ?? '') }}">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor Rangka</label>
                    <input type="text" name="nomor_rangka"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        value="{{ old('nomor_rangka', $barang->nomor_rangka ?? '') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor BPKB</label>
                    <input type="text" name="nomor_bpkb"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        value="{{ old('nomor_bpkb', $barang->nomor_bpkb ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Perolehan & Harga -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Perolehan</label>
            <input type="date" name="tanggal_perolehan"
                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                value="{{ old('tanggal_perolehan', $barang->tanggal_perolehan ?? ($barang->tahun_perolehan ?? '')) }}"
                max="{{ date('Y-m-d') }}">
            <p class="text-xs text-gray-500 mt-1">Pilih tanggal perolehan (jika hanya tahun, pilih 1 Jan tahun tersebut)
            </p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Cara Perolehan</label>
            <input type="text" name="cara_perolehan"
                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                value="{{ old('cara_perolehan', $barang->cara_perolehan ?? '') }}"
                placeholder="Contoh: Pembelian / Hibah / Sewa">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga Satuan (Rp)</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                <input type="number" name="harga_satuan" step="1" min="0"
                    class="w-full pl-10 px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('harga_satuan', $barang->harga_satuan ?? ($barang->harga ?? '')) }}">
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nilai Perolehan (total)</label>
            <div class="relative">
                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                <input type="number" name="nilai_perolehan" step="1" min="0"
                    class="w-full pl-10 px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('nilai_perolehan', $barang->nilai_perolehan ?? '') }}"
                    placeholder="Biarkan kosong agar dihitung otomatis (jumlah × harga satuan)">
            </div>
        </div>
    </div>

    <!-- Status, Lokasi, Pemegang, Keterangan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kondisi</label>
                <select name="kondisi"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition bg-white">
                    <option value="">Pilih Kondisi</option>
                    <option value="Baik" {{ old('kondisi', $barang->kondisi ?? '') == 'Baik' ? 'selected' : '' }}>
                        Baik</option>
                    <option value="Rusak Ringan"
                        {{ old('kondisi', $barang->kondisi ?? '') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                    </option>
                    <option value="Rusak Berat"
                        {{ old('kondisi', $barang->kondisi ?? '') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                    </option>
                    <option value="Perlu Perbaikan"
                        {{ old('kondisi', $barang->kondisi ?? '') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu
                        Perbaikan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Keberadaan</label>
                <select name="keberadaan"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition bg-white">
                    <option value="">Pilih Keberadaan</option>
                    <option value="Ada"
                        {{ old('keberadaan', $barang->keberadaan ?? '') == 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada"
                        {{ old('keberadaan', $barang->keberadaan ?? '') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada
                    </option>
                    <option value="Dipinjam"
                        {{ old('keberadaan', $barang->keberadaan ?? '') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam
                    </option>
                    <option value="Hilang"
                        {{ old('keberadaan', $barang->keberadaan ?? '') == 'Hilang' ? 'selected' : '' }}>Hilang
                    </option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Status Penguasaan</label>
                <select name="status_penguasaan"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition bg-white">
                    <option value="">Pilih Status</option>
                    <option value="Milik"
                        {{ old('status_penguasaan', $barang->status_penguasaan ?? '') == 'Milik' ? 'selected' : '' }}>
                        Milik</option>
                    <option value="Sewa"
                        {{ old('status_penguasaan', $barang->status_penguasaan ?? '') == 'Sewa' ? 'selected' : '' }}>
                        Sewa</option>
                    <option value="Pinjam Pakai"
                        {{ old('status_penguasaan', $barang->status_penguasaan ?? '') == 'Pinjam Pakai' ? 'selected' : '' }}>
                        Pinjam Pakai</option>
                    <option value="Hibah"
                        {{ old('status_penguasaan', $barang->status_penguasaan ?? '') == 'Hibah' ? 'selected' : '' }}>
                        Hibah</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Status Penggunaan</label>
                <input type="text" name="status_penggunaan"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('status_penggunaan', $barang->status_penggunaan ?? '') }}"
                    placeholder="Opsional: mis. sedang digunakan untuk ...">
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Lokasi</label>
                <input type="text" name="lokasi"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('lokasi', $barang->lokasi ?? '') }}" placeholder="Contoh: Ruang IT / Gudang A">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Pemegang</label>
                <input type="text" name="pemegang"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    value="{{ old('pemegang', $barang->pemegang ?? '') }}" placeholder="Nama pemegang atau unit">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">{{ old('keterangan', $barang->keterangan ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="pt-6 border-t border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            <div class="flex gap-3">
                <a href="{{ route('barang.index') }}"
                    class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Kembali
                </a>

                <button type="reset"
                    class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Reset
                </button>
            </div>

            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                {{ $method == 'PUT' ? 'Update Data' : 'Simpan Data' }}
            </button>
        </div>
    </div>
</form>

@push('styles')
    <style>
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            // required fields
            const requiredFields = [
                'kd_aset1', 'kd_aset2', 'kd_aset3', 'kd_aset4', 'kd_aset5',
                'nama_barang', 'jumlah'
            ];

            function markInvalid(el) {
                el.classList.add('border-red-500');
            }

            function unmarkInvalid(el) {
                el.classList.remove('border-red-500');
            }

            // simple on-blur validation
            requiredFields.forEach(name => {
                const el = form.querySelector('[name="' + name + '"]');
                if (!el) return;
                el.addEventListener('blur', function() {
                    if (!this.value || (this.type === 'number' && this.value <= 0)) markInvalid(
                        this);
                    else unmarkInvalid(this);
                });
            });

            // auto-calc nilai_perolehan preview (client-side convenience)
            const jumlahEl = form.querySelector('[name="jumlah"]');
            const hargaSatuanEl = form.querySelector('[name="harga_satuan"]');
            const nilaiPerolehanEl = form.querySelector('[name="nilai_perolehan"]');

            function calcNilai() {
                const j = Number(jumlahEl?.value || 0);
                const h = Number(hargaSatuanEl?.value || 0);
                if (j > 0 && h >= 0 && nilaiPerolehanEl && !nilaiPerolehanEl.value) {
                    nilaiPerolehanEl.value = Math.round(j * h);
                }
            }

            if (jumlahEl && hargaSatuanEl) {
                jumlahEl.addEventListener('input', calcNilai);
                hargaSatuanEl.addEventListener('input', calcNilai);
            }

            // final submit check
            form.addEventListener('submit', function(e) {
                const errors = [];
                requiredFields.forEach(name => {
                    const el = form.querySelector('[name="' + name + '"]');
                    if (!el) return;
                    if (!el.value || (el.type === 'number' && Number(el.value) <= 0)) {
                        markInvalid(el);
                        errors.push(name);
                    } else {
                        unmarkInvalid(el);
                    }
                });

                if (errors.length) {
                    e.preventDefault();
                    alert('Harap isi field wajib: ' + errors.join(', '));
                    const first = form.querySelector('.border-red-500');
                    if (first) first.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        });
    </script>
@endpush
