<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterBarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_barang')->insert([
            [
                'id' => Str::uuid()->toString(),
                'kd_aset1' => '02',
                'kd_aset2' => '03',
                'kd_aset3' => '01',
                'kd_aset4' => '05',
                'kd_aset5' => '001',

                'kode_barang' => '02.03.01.05.001',
                'nibar' => 'NB-001',
                'reg' => 'REG001',

                'nama_barang' => 'Laptop Dell Inspiron 14',
                'spesifikasi_nama' => 'Intel i5, RAM 8GB, SSD 256GB',
                'spesifikasi_lain' => 'Warna hitam, layar 14 inci',

                'merk' => 'Dell',
                'tipe' => 'Inspiron 5402',
                'nopol' => null,
                'nomor_rangka' => null,
                'nomor_bpkb' => null,

                'lokasi' => 'Ruang IT',
                'pemegang' => 'Budi Setiawan',

                'jumlah' => 1,
                'satuan' => 'Unit',

                'tanggal_perolehan' => '2023-03-10',
                'cara_perolehan' => 'Pembelian',
                'harga_satuan' => 8500000,
                'nilai_perolehan' => 8500000,

                'kondisi' => 'Baik',
                'keberadaan' => 'Ruang IT',
                'status_penguasaan' => 'Milik',
                'status_penggunaan' => 'Digunakan aktif',

                'keterangan' => 'Digunakan untuk pekerjaan harian',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => Str::uuid()->toString(),
                'kd_aset1' => '03',
                'kd_aset2' => '02',
                'kd_aset3' => '01',
                'kd_aset4' => '02',
                'kd_aset5' => '015',

                'kode_barang' => '03.02.01.02.015',
                'nibar' => 'NB-002',
                'reg' => 'REG002',

                'nama_barang' => 'Kursi Kantor Hidrolik',
                'spesifikasi_nama' => 'Sandaran tinggi, bahan jaring',
                'spesifikasi_lain' => 'Warna hitam, rotasi 360°',

                'merk' => 'ErgoChair',
                'tipe' => 'Pro-X',
                'nopol' => null,
                'nomor_rangka' => null,
                'nomor_bpkb' => null,

                'lokasi' => 'Ruang Administrasi',
                'pemegang' => 'Siti Nuraini',

                'jumlah' => 10,
                'satuan' => 'Unit',

                'tanggal_perolehan' => '2022-08-20',
                'cara_perolehan' => 'Pembelian',
                'harga_satuan' => 1200000,
                'nilai_perolehan' => 1200000 * 10,

                'kondisi' => 'Baik',
                'keberadaan' => 'Ruang Administrasi',
                'status_penguasaan' => 'Milik',
                'status_penggunaan' => 'Digunakan aktif',

                'keterangan' => 'Digunakan oleh staf administrasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => Str::uuid()->toString(),
                'kd_aset1' => '05',
                'kd_aset2' => '01',
                'kd_aset3' => '02',
                'kd_aset4' => '01',
                'kd_aset5' => '007',

                'kode_barang' => '05.01.02.01.007',
                'nibar' => 'NB-003',
                'reg' => 'REG003',

                'nama_barang' => 'Kendaraan Operasional',
                'spesifikasi_nama' => 'Mobil SUV 1500cc',
                'spesifikasi_lain' => 'Warna putih, transmisi otomatis',

                'merk' => 'Toyota',
                'tipe' => 'Rush',
                'nopol' => 'AB 1234 XY',
                'nomor_rangka' => 'RNG1234567890AB',
                'nomor_bpkb' => 'BPKB987654321',

                'lokasi' => 'Garasi Dinas',
                'pemegang' => 'Pak Johar',

                'jumlah' => 1,
                'satuan' => 'Unit',

                'tanggal_perolehan' => '2021-01-15',
                'cara_perolehan' => 'Pembelian',
                'harga_satuan' => 250000000,
                'nilai_perolehan' => 250000000,

                'kondisi' => 'Baik',
                'keberadaan' => 'Garasi Dinas',
                'status_penguasaan' => 'Milik',
                'status_penggunaan' => 'Digunakan operasional',

                'keterangan' => 'Kendaraan dinas untuk kegiatan lapangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
