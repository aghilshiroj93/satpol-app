@extends('layout.app')

@section('content')
    <div class="p-4 md:p-6">

        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        Detail Barang
                    </h2>
                    <p class="text-gray-500 mt-1">Informasi lengkap data master barang</p>
                </div>

                <div class="flex items-center gap-2">
                    <span
                        class="px-3 py-1 text-xs font-medium rounded-full 
                    {{ $barang->kondisi == 'Baik'
                        ? 'bg-green-100 text-green-800'
                        : ($barang->kondisi == 'Rusak Ringan'
                            ? 'bg-yellow-100 text-yellow-800'
                            : ($barang->kondisi == 'Rusak Berat'
                                ? 'bg-red-100 text-red-800'
                                : ($barang->kondisi == 'Perlu Perbaikan'
                                    ? 'bg-orange-100 text-orange-800'
                                    : 'bg-blue-100 text-blue-800'))) }}">
                        {{ $barang->kondisi ?? 'Tidak Diketahui' }}
                    </span>
                    <span
                        class="px-3 py-1 text-xs font-medium rounded-full 
                    {{ $barang->keberadaan == 'Ada'
                        ? 'bg-green-100 text-green-800'
                        : ($barang->keberadaan == 'Tidak Ada'
                            ? 'bg-red-100 text-red-800'
                            : ($barang->keberadaan == 'Dipinjam'
                                ? 'bg-blue-100 text-blue-800'
                                : ($barang->keberadaan == 'Hilang'
                                    ? 'bg-gray-100 text-gray-800'
                                    : 'bg-gray-100 text-gray-800'))) }}">
                        {{ $barang->keberadaan ?? 'Tidak Diketahui' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column - Informasi Utama -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Kode Aset Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kode Aset
                        </h3>
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                            {{ $barang->kode_barang ?? $barang->kd_aset1 . '.' . $barang->kd_aset2 . '.' . $barang->kd_aset3 . '.' . $barang->kd_aset4 . '.' . $barang->kd_aset5 }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Aset 1</p>
                            <p class="font-semibold text-gray-800">{{ $barang->kd_aset1 }}</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Aset 2</p>
                            <p class="font-semibold text-gray-800">{{ $barang->kd_aset2 }}</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Aset 3</p>
                            <p class="font-semibold text-gray-800">{{ $barang->kd_aset3 }}</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Aset 4</p>
                            <p class="font-semibold text-gray-800">{{ $barang->kd_aset4 }}</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Aset 5</p>
                            <p class="font-semibold text-gray-800">{{ $barang->kd_aset5 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Barang Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        Informasi Barang
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nama Barang</p>
                                <p class="font-semibold text-gray-800">{{ $barang->nama_barang }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Jumlah</p>
                                <p class="font-semibold text-gray-800">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $barang->jumlah ?? 0 }} {{ $barang->satuan ?? 'Unit' }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Merk</p>
                                <p class="font-semibold text-gray-800">{{ $barang->merk ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tipe</p>
                                <p class="font-semibold text-gray-800">{{ $barang->tipe ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">REG</p>
                                <p class="font-semibold text-gray-800">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $barang->reg ?? '-' }}
                                    </span>
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">NIBAR</p>
                                <p class="font-semibold text-gray-800">{{ $barang->nibar ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nomor Polisi</p>
                                <p class="font-semibold text-gray-800">{{ $barang->nopol ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nomor Rangka</p>
                                <p class="font-semibold text-gray-800">{{ $barang->nomor_rangka ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nomor BPKB</p>
                                <p class="font-semibold text-gray-800">{{ $barang->nomor_bpkb ?? '-' }}</p>
                            </div>

                            <!-- Tanggal Perolehan -->
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tanggal Perolehan</p>
                                <p class="font-semibold text-gray-800">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        @if ($barang->tanggal_perolehan)
                                            {{ \Carbon\Carbon::parse($barang->tanggal_perolehan)->translatedFormat('d F Y') }}
                                        @elseif($barang->tahun_perolehan)
                                            {{ \Carbon\Carbon::parse($barang->tahun_perolehan)->translatedFormat('d F Y') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Harga Satuan</p>
                                <p class="font-semibold text-gray-800">
                                    Rp {{ number_format($barang->harga_satuan ?? ($barang->harga ?? 0), 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 mb-1">Nilai Perolehan (Total)</p>
                                <p class="font-semibold text-gray-800 text-lg">
                                    Rp
                                    {{ number_format($barang->nilai_perolehan ?? ($barang->harga_satuan ?? ($barang->harga ?? 0)) * ($barang->jumlah ?? 1), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($barang->spesifikasi_lain)
                        <div class="mt-4 text-sm text-gray-600">
                            <p class="font-medium text-gray-700 mb-1">Spesifikasi & Keterangan:</p>
                            <p>{{ $barang->spesifikasi_lain }}</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right Column - Status dan Tindakan -->
            <div class="space-y-6">

                <!-- Status Barang Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Status Barang
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Kondisi</p>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-3 h-3 rounded-full 
                                {{ $barang->kondisi == 'Baik'
                                    ? 'bg-green-500'
                                    : ($barang->kondisi == 'Rusak Ringan'
                                        ? 'bg-yellow-500'
                                        : ($barang->kondisi == 'Rusak Berat'
                                            ? 'bg-red-500'
                                            : ($barang->kondisi == 'Perlu Perbaikan'
                                                ? 'bg-orange-500'
                                                : 'bg-gray-500'))) }}">
                                </div>
                                <p class="font-semibold text-gray-800">{{ $barang->kondisi ?? 'Tidak Diketahui' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Keberadaan</p>
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-3 h-3 rounded-full 
                                {{ $barang->keberadaan == 'Ada'
                                    ? 'bg-green-500'
                                    : ($barang->keberadaan == 'Tidak Ada'
                                        ? 'bg-red-500'
                                        : ($barang->keberadaan == 'Dipinjam'
                                            ? 'bg-blue-500'
                                            : ($barang->keberadaan == 'Hilang'
                                                ? 'bg-gray-500'
                                                : 'bg-gray-500'))) }}">
                                </div>
                                <p class="font-semibold text-gray-800">{{ $barang->keberadaan ?? 'Tidak Diketahui' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Status Penguasaan</p>
                            <p class="font-semibold text-gray-800">{{ $barang->status_penguasaan ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Pemegang</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-gray-800">{{ $barang->pemegang ?? 'Tidak Ada' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Lokasi</p>
                            <p class="font-semibold text-gray-800">{{ $barang->lokasi ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Status Penggunaan</p>
                            <p class="font-semibold text-gray-800">{{ $barang->status_penggunaan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tindakan Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tindakan</h3>

                    <div class="space-y-3">
                        <a href="{{ route('barang.edit', $barang->id) }}"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Data Barang
                        </a>

                        <a href="{{ route('barang.index') }}"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg font-medium transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar
                        </a>

                        <button onclick="printDetail()"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg font-medium transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Detail
                        </button>
                    </div>
                </div>

                <!-- Informasi Metadata -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Terakhir Diperbarui
                    </div>
                    <p class="text-xs text-gray-500">
                        Data diperbarui: {{ $barang->updated_at ? $barang->updated_at->format('d M Y H:i') : '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        @php
            use Carbon\Carbon;

            $kodeAsetCetak =
                $barang->kode_barang ??
                $barang->kd_aset1 .
                    '.' .
                    $barang->kd_aset2 .
                    '.' .
                    $barang->kd_aset3 .
                    '.' .
                    $barang->kd_aset4 .
                    '.' .
                    $barang->kd_aset5;

            $tanggalPerolehanCetak = $barang->tanggal_perolehan
                ? Carbon::parse($barang->tanggal_perolehan)->format('d/m/Y')
                : ($barang->tahun_perolehan
                    ? Carbon::parse($barang->tahun_perolehan)->format('d/m/Y')
                    : '-');

            $hargaSatuanCetak = 'Rp ' . number_format($barang->harga_satuan ?? ($barang->harga ?? 0), 0, ',', '.');

            $nilaiPerolehanCetak =
                'Rp ' .
                number_format(
                    $barang->nilai_perolehan ??
                        ($barang->harga_satuan ?? ($barang->harga ?? 0)) * ($barang->jumlah ?? 1),
                    0,
                    ',',
                    '.',
                );

            $printData = [
                'kodeAset' => $kodeAsetCetak,
                'nibar' => $barang->nibar ?? '-',
                'nama_barang' => $barang->nama_barang ?? '-',
                'reg' => $barang->reg ?? '-',
                'jumlah' => $barang->jumlah ?? 0,
                'satuan' => $barang->satuan ?? 'Unit',
                'merk_tipe' => trim(($barang->merk ?? '') . ' ' . ($barang->tipe ?? '')) ?: '-',
                'lokasi' => $barang->lokasi ?? '-',
                'nopol' => $barang->nopol ?? '-',
                'nomor_rangka_bpkb' => ($barang->nomor_rangka ?? '-') . ' / ' . ($barang->nomor_bpkb ?? '-'),
                'tanggal_perolehan' => $tanggalPerolehanCetak,
                'cara_perolehan' => $barang->cara_perolehan ?? '-',
                'harga_satuan' => $hargaSatuanCetak,
                'nilai_perolehan' => $nilaiPerolehanCetak,
                'kondisi' => $barang->kondisi ?? '-',
                'keberadaan' => $barang->keberadaan ?? '-',
                'pemegang' => $barang->pemegang ?? '-',
                'status_penggunaan' => $barang->status_penggunaan ?? '-',
                'keterangan' => $barang->keterangan ?? '-',
            ];
        @endphp

        <script>
            // data sudah di-encode aman oleh Blade
            const printData = @json($printData);

            function printDetail() {
                const now = new Date();
                const printContent = `
            <html>
                <head>
                    <meta charset="utf-8"/>
                    <title>Detail Barang - ${printData.nama_barang}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; color: #222 }
                        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
                        .header h1 { color: #333; margin: 0; font-size: 20px; }
                        .section { margin-bottom: 16px; }
                        .section h2 { color: #2c5282; border-bottom: 1px solid #ddd; padding-bottom: 6px; font-size: 16px; }
                        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 8px; }
                        .info-label { color: #666; font-size: 12px; }
                        .info-value { font-weight: bold; color: #111; font-size: 13px; }
                        .small { font-size: 12px; color:#666 }
                        @media print { .no-print { display: none; } }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Detail Barang</h1>
                        <p class="small">Kode Aset: ${printData.kodeAset}</p>
                        <p class="small">NIBAR: ${printData.nibar}</p>
                        <p class="small">Tanggal Cetak: ${now.toLocaleDateString('id-ID')}</p>
                    </div>

                    <div class="section">
                        <h2>Informasi Barang</h2>
                        <div class="info-grid">
                            <div>
                                <div class="info-label">Nama Barang</div>
                                <div class="info-value">${printData.nama_barang}</div>
                            </div>
                            <div>
                                <div class="info-label">REG</div>
                                <div class="info-value">${printData.reg}</div>
                            </div>
                            <div>
                                <div class="info-label">Jumlah</div>
                                <div class="info-value">${printData.jumlah} ${printData.satuan}</div>
                            </div>
                            <div>
                                <div class="info-label">Merk / Tipe</div>
                                <div class="info-value">${printData.merk_tipe}</div>
                            </div>
                            <div>
                                <div class="info-label">Lokasi</div>
                                <div class="info-value">${printData.lokasi}</div>
                            </div>
                            <div>
                                <div class="info-label">Nomor Polisi</div>
                                <div class="info-value">${printData.nopol}</div>
                            </div>
                            <div>
                                <div class="info-label">Nomor Rangka / BPKB</div>
                                <div class="info-value">${printData.nomor_rangka_bpkb}</div>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2>Perolehan & Nilai</h2>
                        <div class="info-grid">
                            <div>
                                <div class="info-label">Tanggal Perolehan</div>
                                <div class="info-value">${printData.tanggal_perolehan}</div>
                            </div>
                            <div>
                                <div class="info-label">Cara Perolehan</div>
                                <div class="info-value">${printData.cara_perolehan}</div>
                            </div>
                            <div>
                                <div class="info-label">Harga Satuan</div>
                                <div class="info-value">${printData.harga_satuan}</div>
                            </div>
                            <div>
                                <div class="info-label">Nilai Perolehan (Total)</div>
                                <div class="info-value">${printData.nilai_perolehan}</div>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2>Status & Catatan</h2>
                        <div class="info-grid">
                            <div>
                                <div class="info-label">Kondisi</div>
                                <div class="info-value">${printData.kondisi}</div>
                            </div>
                            <div>
                                <div class="info-label">Keberadaan</div>
                                <div class="info-value">${printData.keberadaan}</div>
                            </div>
                            <div>
                                <div class="info-label">Pemegang</div>
                                <div class="info-value">${printData.pemegang}</div>
                            </div>
                            <div>
                                <div class="info-label">Status Penggunaan</div>
                                <div class="info-value">${printData.status_penggunaan}</div>
                            </div>
                        </div>

                        <div style="margin-top:12px;">
                            <div class="info-label">Keterangan</div>
                            <div class="info-value">${printData.keterangan}</div>
                        </div>
                    </div>

                    <div class="section no-print small" style="text-align:center; margin-top:18px;">
                        Dokumen ini dicetak dari Sistem Inventaris Barang
                    </div>
                </body>
            </html>
        `;

                const printWindow = window.open('', '_blank');
                printWindow.document.write(printContent);
                printWindow.document.close();
                printWindow.focus();

                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 300);
            }
        </script>
    @endpush
@endsection
