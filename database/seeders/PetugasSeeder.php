<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('petugas')->insert([
            [
                'id' => Str::uuid()->toString(),
                'nama_lengkap' => 'Admin Utama',
                'username' => 'admin',
                'password' => Hash::make('admin123'), // password default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'nama_lengkap' => 'Petugas Lapangan',
                'username' => 'petugas1',
                'password' => Hash::make('petugas123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
