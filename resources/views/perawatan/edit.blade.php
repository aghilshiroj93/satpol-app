{{-- resources/views/perawatan/edit.blade.php --}}
@extends('layout.app')

@section('title', 'Edit Data Perawatan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Perawatan</h1>
        <p class="text-gray-600 mt-1">Edit data perawatan untuk barang: {{ $perawatan->barang->nama_barang }}</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Form Edit Perawatan</h2>
        </div>
        <div class="p-5">
            <form action="{{ route('perawatan.update', $perawatan->id) }}" method="POST" enctype="multipart/form-data">
                @include('perawatan._form')
            </form>
        </div>
    </div>
</div>
@endsection