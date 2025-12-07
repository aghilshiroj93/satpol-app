<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perawatan extends Model
{
    protected $table = 'perawatan';
    
    protected $fillable = [
        'barang_id',
        'jenis_perawatan',
        'deskripsi',
        'tanggal_perawatan',
        'jadwal_perawatan_berikutnya',
        'teknisi',
        'vendor',
        'biaya',
        'status',
        'foto_sebelum',
        'foto_sesudah',
        'catatan',
    ];

    protected $casts = [
        'tanggal_perawatan' => 'date',
        'jadwal_perawatan_berikutnya' => 'date',
        'biaya' => 'decimal:2',
    ];

    // ✅ RELASI KE MASTER BARANG
    public function barang(): BelongsTo
    {
        return $this->belongsTo(MasterBarang::class, 'barang_id', 'id');
    }
    
    // ✅ ACCESSOR UNTUK NAMA BARANG (bisa digunakan di view)
    public function getNamaBarangAttribute()
    {
        return $this->barang ? $this->barang->nama_barang : 'Barang tidak ditemukan';
    }
    
    // ✅ ACCESSOR UNTUK INFO LENGKAP BARANG
    public function getInfoBarangAttribute()
    {
        return $this->barang ? $this->barang->info_lengkap : '-';
    }
    
    // ✅ ACCESSOR UNTUK WARNA STATUS
    public function getStatusWarnaAttribute()
    {
        return match($this->status) {
            'Selesai' => 'success',
            'Dalam proses' => 'warning',
            'Terjadwal' => 'info',
            default => 'secondary',
        };
    }
    
    // ✅ SCOPES UNTUK FILTER
    public function scopeFilterStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }
    
    public function scopeFilterBarang($query, $barangId)
    {
        if ($barangId) {
            return $query->where('barang_id', $barangId);
        }
        return $query;
    }
    
    public function scopeFilterTanggal($query, $dari, $sampai)
    {
        if ($dari && $sampai) {
            return $query->whereBetween('tanggal_perawatan', [$dari, $sampai]);
        }
        return $query;
    }
    
    public function scopeFilterJenis($query, $jenis)
    {
        if ($jenis) {
            return $query->where('jenis_perawatan', 'like', "%{$jenis}%");
        }
        return $query;
    }
    
    // ✅ METHOD UNTUK STATISTIK
    public static function getStatistik()
    {
        return [
            'total' => self::count(),
            'selesai' => self::where('status', 'Selesai')->count(),
            'dalam_proses' => self::where('status', 'Dalam proses')->count(),
            'terjadwal' => self::where('status', 'Terjadwal')->count(),
            'total_biaya' => self::sum('biaya'),
        ];
    }
}