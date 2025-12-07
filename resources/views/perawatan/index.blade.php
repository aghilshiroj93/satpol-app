@extends('layout.app')

@section('title', 'Data Perawatan Barang')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Perawatan Barang</h1>
            <p class="text-gray-600 mt-1">Kelola jadwal dan riwayat perawatan barang</p>
        </div>
        <a href="{{ route('perawatan.create') }}" 
           class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="ri-add-line mr-2"></i> Tambah Perawatan
        </a>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Perawatan</p>
                    <h3 class="text-2xl font-bold mt-2">{{ $statistik['total'] }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <i class="ri-tools-line text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Selesai</p>
                    <h3 class="text-2xl font-bold mt-2">{{ $statistik['selesai'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <i class="ri-checkbox-circle-line text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Dalam Proses</p>
                    <h3 class="text-2xl font-bold mt-2">{{ $statistik['dalam_proses'] }}</h3>
                </div>
                <div class="p-3 bg-yellow-50 rounded-lg">
                    <i class="ri-time-line text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow p-5">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Biaya</p>
                    <h3 class="text-2xl font-bold mt-2">Rp {{ number_format($statistik['total_biaya'], 0, ',', '.') }}</h3>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg">
                    <i class="ri-money-dollar-circle-line text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow mb-6">
        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Filter Data</h2>
        </div>
        <div class="p-5">
            <form method="GET" action="{{ route('perawatan.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                        <select name="barang_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Barang</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->id }}" {{ request('barang_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_barang }} - {{ $item->merk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dalam proses" {{ request('status') == 'Dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="Terjadwal" {{ request('status') == 'Terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="dari" value="{{ request('dari') }}" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="sampai" value="{{ request('sampai') }}" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Perawatan</label>
                        <input type="text" name="jenis" value="{{ request('jenis') }}" 
                               placeholder="Cari jenis..." 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                            <i class="ri-search-line mr-2"></i> Filter
                        </button>
                        <a href="{{ route('perawatan.index') }}" 
                           class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg flex items-center">
                            <i class="ri-refresh-line mr-2"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($perawatan as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration + ($perawatan->currentPage() - 1) * $perawatan->perPage() }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="font-medium text-gray-900">{{ $item->barang->nama_barang }}</div>
                                <div class="text-sm text-gray-500">{{ $item->barang->merk }} {{ $item->barang->tipe }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->jenis_perawatan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->tanggal_perawatan->format('d/m/Y') }}</div>
                            @if($item->jadwal_perawatan_berikutnya)
                                <div class="text-xs text-gray-500">Next: {{ $item->jadwal_perawatan_berikutnya->format('d/m/Y') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColor = match($item->status) {
                                    'Selesai' => 'bg-green-100 text-green-800',
                                    'Dalam proses' => 'bg-yellow-100 text-yellow-800',
                                    'Terjadwal' => 'bg-blue-100 text-blue-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($item->biaya)
                                <span class="font-medium">Rp {{ number_format($item->biaya, 0, ',', '.') }}</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('perawatan.show', $item->id) }}" 
                                   class="text-blue-600 hover:text-blue-900" title="Detail">
                                    <i class="ri-eye-line"></i>
                                </a>
                                <a href="{{ route('perawatan.edit', $item->id) }}" 
                                   class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <i class="ri-pencil-line"></i>
                                </a>
                                <form action="{{ route('perawatan.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus data perawatan ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="ri-inbox-line text-4xl mb-3"></i>
                                <p class="text-lg">Tidak ada data perawatan</p>
                                <p class="text-sm mt-1">Mulai dengan menambahkan data perawatan baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($perawatan->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="text-sm text-gray-700 mb-4 md:mb-0">
                    Menampilkan {{ $perawatan->firstItem() ?? 0 }} sampai {{ $perawatan->lastItem() ?? 0 }} 
                    dari {{ $perawatan->total() }} data
                </div>
                <div class="flex items-center space-x-2">
                    {{ $perawatan->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Konfirmasi hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[onsubmit]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection