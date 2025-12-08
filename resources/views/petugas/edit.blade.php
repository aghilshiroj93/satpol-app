@extends('layout.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Petugas</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('petugas._form', ['petugas' => $petugas, 'submit' => 'Update'])
            </form>
        </div>
    </div>
@endsection
