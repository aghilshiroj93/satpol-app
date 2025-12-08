@extends('layout.app')

@section('content')
    <div class="p-4 md:p-6">

        <!-- Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        Data Barang
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Kelola inventaris barang secara lengkap</p>
                </div>

                <a href="{{ route('barang.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang
                </a>
            </div>

            <!-- Pencarian & Filter (server-side) -->
            <form method="GET" action="{{ route('barang.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input name="q" type="text" id="searchInput" value="{{ request('q') }}"
                        placeholder="Cari nama / kode / merk / tipe..."
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <select name="kondisi" id="filterKondisi"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kondisi</option>
                    <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                    </option>
                    <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                    </option>
                    <option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu
                        Perbaikan</option>
                </select>

                <select name="keberadaan" id="filterKeberadaan"
                    class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Keberadaan</option>
                    <option value="Ada" {{ request('keberadaan') == 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada" {{ request('keberadaan') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada
                    </option>
                    <option value="Dipinjam" {{ request('keberadaan') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Hilang" {{ request('keberadaan') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Terapkan
                    </button>
                    <a href="{{ route('barang.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-green-800">Berhasil!</p>
                    <p class="text-green-600 text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Tabel Barang -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kode
                                Aset</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama
                                & Spesifikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Tanggal Perolehan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nilai
                                Perolehan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">REG /
                                NIBAR</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($barang as $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{-- Jika kamu generate kode_barang di model, tampilkan itu; fallback ke kd_aset --}}
                                        {{ $item->kode_barang ?? $item->kd_aset1 . '.' . $item->kd_aset2 . '.' . $item->kd_aset3 }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $item->kd_aset4 }}.{{ $item->kd_aset5 }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ \Illuminate\Support\Str::limit($item->nama_barang, 60) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        @if ($item->spesifikasi_nama)
                                            {{ $item->spesifikasi_nama }}
                                        @elseif($item->merk || $item->tipe)
                                            {{ trim(($item->merk ? $item->merk : '') . ' ' . ($item->tipe ? $item->tipe : '')) }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                    @if ($item->spesifikasi_lain)
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ \Illuminate\Support\Str::limit($item->spesifikasi_lain, 80) }}</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $item->jumlah ?? 0 }} {{ $item->satuan ? $item->satuan : '' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1">
                                        <span
                                            class="w-2 h-2 rounded-full 
                                        {{ $item->kondisi == 'Baik'
                                            ? 'bg-green-500'
                                            : ($item->kondisi == 'Rusak Ringan'
                                                ? 'bg-yellow-500'
                                                : ($item->kondisi == 'Rusak Berat'
                                                    ? 'bg-red-500'
                                                    : ($item->kondisi == 'Perlu Perbaikan'
                                                        ? 'bg-orange-500'
                                                        : 'bg-gray-500'))) }}">
                                        </span>
                                        <span class="text-sm">{{ $item->kondisi ?: '-' }}</span>
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($item->tanggal_perolehan)
                                        {{ \Carbon\Carbon::parse($item->tanggal_perolehan)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{-- prioritaskan nilai_perolehan, fallback ke harga_satuan --}}
                                    @php
                                        $displayHarga =
                                            $item->nilai_perolehan ??
                                            ($item->harga_satuan
                                                ? $item->harga_satuan * ($item->jumlah ?? 1)
                                                : $item->harga ?? 0);
                                    @endphp
                                    Rp {{ number_format($displayHarga ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $item->reg ?: '-' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $item->nibar ?: '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('barang.show', $item->id) }}"
                                            class="px-3 py-1.5 text-xs bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                            Detail
                                        </a>

                                        <a href="{{ route('barang.edit', $item->id) }}"
                                            class="px-3 py-1.5 text-xs bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada data barang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if (method_exists($barang, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $barang->firstItem() ?? 0 }} - {{ $barang->lastItem() ?? 0 }} dari
                            {{ $barang->total() ?? 0 }} barang
                        </div>
                        <div>
                            {{ $barang->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>

    @push('scripts')
        <script>
            // Optional: fokus kursor ke searchInput saat halaman dibuka
            document.addEventListener('DOMContentLoaded', function() {
                const search = document.getElementById('searchInput');
                if (search) search.focus();
            });
        </script>
    @endpush
@endsection
