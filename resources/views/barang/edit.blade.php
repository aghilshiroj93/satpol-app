@extends('layout.app')

@section('content')
<div class="container">
    <h3>Edit Barang</h3>

    @include('barang._form', [
        'action' => route('barang.update', $barang->id),
        'method' => 'PUT',
        'barang' => $barang
    ])
</div>
@endsection
