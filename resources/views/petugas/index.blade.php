@extends('layout.app')

@section('content')
    <div class="p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Petugas</h1>

            <a href="{{ route('petugas.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
                + Tambah Petugas
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3">Nama Lengkap</th>
                        <th class="p-3">Username</th>
                        <th class="p-3 w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($petugas as $p)
                        <tr class="border-t">
                            <td class="p-3">{{ $p->nama_lengkap }}</td>
                            <td class="p-3">{{ $p->username }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('petugas.edit', $p->id) }}"
                                    class="px-2 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('petugas.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus petugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-2 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-3 text-center text-gray-500">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $petugas->links() }}
        </div>

    </div>
@endsection
