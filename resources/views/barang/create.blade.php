@extends('layout.app')

@section('content')
<div class="container">
    <h3>Tambah Barang</h3>

    @include('barang._form', [
        'action' => route('barang.store'),
        'method' => 'POST',
        'barang' => null
    ])
</div>
@endsection
