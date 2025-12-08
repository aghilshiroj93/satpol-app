{{-- resources/views/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="p-4 md:p-6 max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd" />
                    </svg>
                    Manajemen User
                </h2>
                <p class="text-gray-500 text-sm mt-1">Kelola akun dan identitas pengguna</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            </div>
        </div>

        <!-- Flash -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-green-800">Berhasil!</p>
                    <p class="text-green-600 text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Search -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="relative md:col-span-2">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input name="q" type="text" id="searchInput" value="{{ request('q') }}"
                        placeholder="Cari nama / email / jabatan..."
                        class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">Cari</button>
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Reset</a>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Foto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Jabatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $i => $user)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $users->firstItem() + $i }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $fotoUrl = null;
                                        if (!empty($user->foto)) {
                                            // kalau sudah URL eksternal
                                            if (
                                                \Illuminate\Support\Str::startsWith($user->foto, [
                                                    'http://',
                                                    'https://',
                                                ])
                                            ) {
                                                $fotoUrl = $user->foto;
                                            } else {
                                                // cek langsung di disk public
                                                if (
                                                    \Illuminate\Support\Facades\Storage::disk('public')->exists(
                                                        $user->foto,
                                                    )
                                                ) {
                                                    $fotoUrl = \Illuminate\Support\Facades\Storage::disk('public')->url(
                                                        $user->foto,
                                                    );
                                                } else {
                                                    // beberapa kasus path disimpan dengan prefix "storage/" -> coba hapus
                                                    $maybe = preg_replace('#^storage/#', '', $user->foto);
                                                    if (
                                                        \Illuminate\Support\Facades\Storage::disk('public')->exists(
                                                            $maybe,
                                                        )
                                                    ) {
                                                        $fotoUrl = \Illuminate\Support\Facades\Storage::disk(
                                                            'public',
                                                        )->url($maybe);
                                                    }
                                                }
                                            }
                                        }
                                    @endphp

                                    @if ($fotoUrl)
                                        <img src="{{ $fotoUrl }}" alt="foto"
                                            class="w-12 h-12 rounded object-cover border">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded bg-gray-100 flex items-center justify-center text-sm text-gray-400 border">
                                            -</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->nama ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->email ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->jabatan ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->telepon ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="px-3 py-1.5 text-xs bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs bg-red-50 text-red-700 rounded-lg hover:bg-red-100">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if (method_exists($users, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari
                            {{ $users->total() ?? 0 }} user
                        </div>
                        <div>
                            {{ $users->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const search = document.getElementById('searchInput');
                if (search) search.focus();
            });
        </script>
    @endpush
@endsection
