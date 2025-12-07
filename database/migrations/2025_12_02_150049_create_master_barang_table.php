<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_barang', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // penggolongan / kode aset (sudah ada)
            $table->string('kd_aset1', 10)->nullable();
            $table->string('kd_aset2', 10)->nullable();
            $table->string('kd_aset3', 10)->nullable();
            $table->string('kd_aset4', 10)->nullable();
            $table->string('kd_aset5', 10)->nullable();

            // data identitas barang
            $table->string('kode_barang')->nullable()->comment('Kode Barang lengkap (gabungan kd_aset*)');
            $table->string('nibar', 50)->nullable()->comment('NIBAR / nomor inventarisasi barang');
            $table->string('reg', 50)->nullable()->comment('Nomor register');

            // nama & spesifikasi
            $table->string('nama_barang', 150);
            $table->string('spesifikasi_nama', 150)->nullable()->comment('Spesifikasi nama barang (mis: kapasitas, material)');
            $table->text('spesifikasi_lain')->nullable()->comment('Spesifikasi lainnya / keterangan teknis');

            // merk / tipe / kendaraan
            $table->string('merk', 100)->nullable();
            $table->string('tipe', 100)->nullable();
            $table->string('nopol', 50)->nullable()->comment('Nomor polisi (kendaraan)');
            $table->string('nomor_rangka', 100)->nullable();
            $table->string('nomor_bpkb', 100)->nullable();

            // lokasi & pemegang
            $table->string('lokasi', 200)->nullable();
            $table->string('pemegang', 100)->nullable();

            // kuantitas & satuan
            $table->integer('jumlah')->default(1);
            $table->string('satuan', 30)->nullable();

            // perolehan & harga
            $table->date('tanggal_perolehan')->nullable()->comment('Tanggal perolehan barang');
            $table->string('cara_perolehan', 100)->nullable()->comment('Contoh: Pembelian / Hibah / Tukar / Pemberian');
            $table->bigInteger('harga_satuan')->nullable()->comment('Harga satuan perolehan (Rp)');
            $table->bigInteger('nilai_perolehan')->nullable()->comment('Total nilai perolehan (Rp)');

            // kondisi/status
            $table->string('kondisi', 50)->nullable()->comment('Baik / Rusak Ringan / Rusak Berat / Tidak Ditemukan');
            $table->string('keberadaan', 50)->nullable()->comment('Contoh: Ruang A / Gudang / Dipinjam');
            $table->string('status_penguasaan', 50)->nullable()->comment('Milik / Pinjam / Sewa / Dikuasai');
            $table->string('status_penggunaan', 100)->nullable()->comment('Status penggunaan saat ini');

            // tambahan umum
            $table->text('keterangan')->nullable();

            // soft delete & timestamps
            $table->softDeletes();
            $table->timestamps();

            // indexes sederhana (opsional tapi direkomendasikan)
            $table->index(['nibar']);
            $table->index(['reg']);
            $table->index(['kode_barang']);
            $table->index(['lokasi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_barang');
    }
};
