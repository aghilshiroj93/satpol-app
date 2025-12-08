@extends('layout.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Detail Petugas</h1>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div>
            <p class="text-gray-500 text-sm">Nama Lengkap</p>
            <p class="text-lg font-semibold">{{ $petugas->nama_lengkap }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Username</p>
            <p class="text-lg font-semibold">{{ $petugas->username }}</p>
        </div>

        <div class="pt-4">
            <a href="{{ route('petugas.index') }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-800">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
