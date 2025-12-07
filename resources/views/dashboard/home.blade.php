@extends('layout.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
    <p class="text-gray-500 text-sm">Ringkasan sistem inventaris</p>
</div>

<!-- STATISTIC CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Barang</p>
                <h3 class="text-3xl font-semibold mt-1">128</h3>
            </div>
            <i class="ri-archive-fill text-4xl text-blue-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Barang Rusak</p>
                <h3 class="text-3xl font-semibold mt-1">12</h3>
            </div>
            <i class="ri-alert-line text-4xl text-red-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Lokasi Aktif</p>
                <h3 class="text-3xl font-semibold mt-1">6</h3>
            </div>
            <i class="ri-map-pin-2-fill text-4xl text-purple-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Perawatan Bulan Ini</p>
                <h3 class="text-3xl font-semibold mt-1">4</h3>
            </div>
            <i class="ri-tools-fill text-4xl text-green-500"></i>
        </div>
    </div>

</div>

<!-- ACTIVITY TABLE -->
<div class="mt-10 bg-white p-6 rounded-xl shadow">
    <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600">
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Nama Aktivitas</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="p-3">2025-02-01</td>
                    <td class="p-3">Update kondisi barang</td>
                    <td class="p-3"><span class="text-blue-600 font-medium">Selesai</span></td>
                </tr>

                <tr class="border-b">
                    <td class="p-3">2025-01-30</td>
                    <td class="p-3">Tambah lokasi baru</td>
                    <td class="p-3"><span class="text-green-600 font-medium">Baru</span></td>
                </tr>

                <tr class="border-b">
                    <td class="p-3">2025-01-25</td>
                    <td class="p-3">Penghapusan barang</td>
                    <td class="p-3"><span class="text-red-600 font-medium">Dihapus</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
