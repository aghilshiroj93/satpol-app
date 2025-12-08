<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PerawatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua UUID master_barang untuk dipakai sebagai FK
        $barang = DB::table('master_barang')->pluck('id');

        if ($barang->isEmpty()) {
            return; // kalau kosong, biar tidak error
        }

        DB::table('perawatan')->insert([
            [
                'barang_id' => $barang->random(),  // karena UUID
                'jenis_perawatan' => 'Perawatan Rutin',
                'deskripsi' => 'Pembersihan dan pengecekan perangkat.',
                'tanggal_perawatan' => now()->subDays(7),
                'jadwal_perawatan_berikutnya' => now()->addDays(30),
                'teknisi' => 'Andi Saputra',
                'vendor' => 'PT Servis Jaya',
                'biaya' => 150000,
                'status' => 'Selesai',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
                'catatan' => 'Perangkat dalam kondisi baik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => $barang->random(),
                'jenis_perawatan' => 'Penggantian Sparepart',
                'deskripsi' => 'Mengganti komponen yang rusak.',
                'tanggal_perawatan' => now()->subDays(3),
                'jadwal_perawatan_berikutnya' => now()->addDays(60),
                'teknisi' => 'Rudi Hartono',
                'vendor' => 'CV Mekanik Baru',
                'biaya' => 350000,
                'status' => 'Dalam proses',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
                'catatan' => 'Menunggu sparepart datang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => $barang->random(),
                'jenis_perawatan' => 'Perawatan Besar',
                'deskripsi' => 'Overhaul unit untuk meningkatkan performa.',
                'tanggal_perawatan' => now(),
                'jadwal_perawatan_berikutnya' => now()->addDays(90),
                'teknisi' => 'Agus Prasetyo',
                'vendor' => 'PT Teknologi Unggul',
                'biaya' => 750000,
                'status' => 'Terjadwal',
                'foto_sebelum' => null,
                'foto_sesudah' => null,
                'catatan' => 'Siapkan alat tambahan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
