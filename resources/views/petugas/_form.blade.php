@csrf

<div class="space-y-4">

    {{-- Nama Lengkap --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $petugas->nama_lengkap ?? '') }}"
            class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>
        @error('nama_lengkap')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Username --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" value="{{ old('username', $petugas->username ?? '') }}"
            class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>
        @error('username')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>

        <input type="password" name="password"
            class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            @if (!isset($petugas)) required @endif>

        @isset($petugas)
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
        @endisset

        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password Confirmation --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
            class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            @if (!isset($petugas)) required @endif>
    </div>

</div>

{{-- Submit --}}
<div class="mt-6 flex justify-end gap-2">
    <a href="{{ route('petugas.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">
        Kembali
    </a>

    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
        {{ $submit ?? 'Simpan' }}
    </button>
</div>
