@extends('layout.app')

@section('title', 'Detail Perawatan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Perawatan</h1>
        <p class="text-gray-600 mt-1">Informasi lengkap perawatan barang</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Perawatan -->
            <div class="bg-white rounded-xl shadow">
                <div class="p-5 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Perawatan</h2>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Barang -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Barang</p>
                            <p class="font-medium">{{ $perawatan->barang->nama_barang }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Merk/Tipe</p>
                            <p class="font-medium">{{ $perawatan->barang->merk }} {{ $perawatan->barang->tipe }}</p>
                        </div>
                    </div>

                    <!-- Jenis dan Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Jenis Perawatan</p>
                            <p class="font-medium">{{ $perawatan->jenis_perawatan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @php
                                $statusColor = match($perawatan->status) {
                                    'Selesai' => 'bg-green-100 text-green-800',
                                    'Dalam proses' => 'bg-yellow-100 text-yellow-800',
                                    'Terjadwal' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColor }}">
                                {{ $perawatan->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Perawatan</p>
                            <p class="font-medium">{{ $perawatan->tanggal_perawatan->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jadwal Berikutnya</p>
                            <p class="font-medium">
                                @if($perawatan->jadwal_perawatan_berikutnya)
                                    {{ $perawatan->jadwal_perawatan_berikutnya->format('d F Y') }}
                                @else
                                    <span class="text-gray-400">Belum dijadwalkan</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $perawatan->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Teknisi dan Vendor -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Teknisi/Petugas</p>
                            <p class="font-medium">{{ $perawatan->teknisi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Vendor/Perusahaan</p>
                            <p class="font-medium">{{ $perawatan->vendor ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Biaya dan Tanggal Input -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Biaya</p>
                            <p class="font-medium">
                                @if($perawatan->biaya)
                                    Rp {{ number_format($perawatan->biaya, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-400">Tidak ada biaya</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Input</p>
                            <p class="font-medium">{{ $perawatan->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Catatan -->
                    @if($perawatan->catatan)
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Catatan</p>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-800">{{ $perawatan->catatan }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Foto -->
            <div class="bg-white rounded-xl shadow">
                <div class="p-5 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Foto Dokumentasi</h2>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Foto Sebelum -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Sebelum Perawatan</p>
                        @if($perawatan->foto_sebelum)
                            <a href="{{ asset('storage/' . $perawatan->foto_sebelum) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/' . $perawatan->foto_sebelum) }}" 
                                     alt="Foto sebelum" 
                                     class="w-full h-48 object-cover rounded-lg border hover:opacity-90 transition">
                            </a>
                        @else
                            <div class="bg-gray-50 rounded-lg h-48 flex items-center justify-center">
                                <div class="text-center text-gray-400">
                                    <i class="ri-image-line text-3xl mb-2"></i>
                                    <p class="text-sm">Tidak ada foto</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Foto Sesudah -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Sesudah Perawatan</p>
                        @if($perawatan->foto_sesudah)
                            <a href="{{ asset('storage/' . $perawatan->foto_sesudah) }}" target="_blank" class="block">
                                <img src="{{ asset('storage/' . $perawatan->foto_sesudah) }}" 
                                     alt="Foto sesudah" 
                                     class="w-full h-48 object-cover rounded-lg border hover:opacity-90 transition">
                            </a>
                        @else
                            <div class="bg-gray-50 rounded-lg h-48 flex items-center justify-center">
                                <div class="text-center text-gray-400">
                                    <i class="ri-image-line text-3xl mb-2"></i>
                                    <p class="text-sm">Tidak ada foto</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="bg-white rounded-xl shadow">
                <div class="p-5 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Aksi</h2>
                </div>
                <div class="p-5 space-y-3">
                    <a href="{{ route('perawatan.edit', $perawatan->id) }}" 
                       class="w-full bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-medium py-2 px-4 rounded-lg flex items-center justify-center">
                        <i class="ri-pencil-line mr-2"></i> Edit Data
                    </a>
                    <form action="{{ route('perawatan.destroy', $perawatan->id) }}" method="POST" 
                          onsubmit="return confirm('Hapus data perawatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-100 hover:bg-red-200 text-red-800 font-medium py-2 px-4 rounded-lg flex items-center justify-center">
                            <i class="ri-delete-bin-line mr-2"></i> Hapus Data
                        </button>
                    </form>
                    <a href="{{ route('perawatan.index') }}" 
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg flex items-center justify-center">
                        <i class="ri-arrow-left-line mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection