@extends('layout.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Petugas</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('petugas.store') }}" method="POST">
                @include('petugas._form', ['submit' => 'Tambah'])
            </form>
        </div>
    </div>
@endsection
