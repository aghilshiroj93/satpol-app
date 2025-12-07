<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('perawatan', function (Blueprint $table) {
        $table->id();
        
        // ✅ UBAH MENJADI UUID
        $table->uuid('barang_id');
        
        $table->string('jenis_perawatan');
        $table->text('deskripsi');
        $table->date('tanggal_perawatan');
        $table->date('jadwal_perawatan_berikutnya')->nullable();
        $table->string('teknisi')->nullable();
        $table->string('vendor')->nullable();
        $table->decimal('biaya', 15, 2)->nullable();
        $table->enum('status', ['Selesai', 'Dalam proses', 'Terjadwal'])->default('Selesai');
        $table->string('foto_sebelum')->nullable();
        $table->string('foto_sesudah')->nullable();
        $table->text('catatan')->nullable();
        $table->timestamps();

        // ✅ SESUAIKAN DENGAN UUID
        $table->foreign('barang_id')->references('id')->on('master_barang')->cascadeOnDelete();
        
        // ✅ TAMBAHKAN INDEX UNTUK PERFORMANCE
        $table->index('barang_id');
        $table->index('status');
        $table->index('tanggal_perawatan');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan');
    }
};
