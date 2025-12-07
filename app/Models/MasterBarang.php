<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MasterBarang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'master_barang';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Mass assignable
     */
    protected $fillable = [
        // kode aset / pengelompokan
        'kd_aset1',
        'kd_aset2',
        'kd_aset3',
        'kd_aset4',
        'kd_aset5',
        'kode_barang',
        'nibar',
        'reg',

        // identitas & spesifikasi
        'nama_barang',
        'spesifikasi_nama',
        'spesifikasi_lain',

        // merk / tipe / kendaraan
        'merk',
        'tipe',
        'nopol',
        'nomor_rangka',
        'nomor_bpkb',

        // lokasi & pemegang
        'lokasi',
        'pemegang',

        // kuantitas & satuan
        'jumlah',
        'satuan',

        // perolehan & harga
        'tanggal_perolehan',
        'cara_perolehan',
        'harga_satuan',
        'nilai_perolehan',

        // kondisi / status
        'kondisi',
        'keberadaan',
        'status_penguasaan',
        'status_penggunaan',

        // tambahan
        'keterangan',

        // lama fields (jika masih ada)
        'tahun_perolehan',
        'harga'
    ];

    /**
     * Casts
     */
    protected $casts = [
        'tanggal_perolehan' => 'date',
        'tahun_perolehan' => 'date',
        'harga_satuan' => 'integer',
        'nilai_perolehan' => 'integer',
        'harga' => 'integer',
        'jumlah' => 'integer',
    ];

    /**
     * Boot model - set UUID dan default kode_barang jika kosong
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // UUID
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }

            // Jika kode_barang kosong, generate dari kd_aset1..5 (gabungkan non-null dengan titik)
            if (empty($model->kode_barang)) {
                $parts = array_filter([
                    $model->kd_aset1 ?? null,
                    $model->kd_aset2 ?? null,
                    $model->kd_aset3 ?? null,
                    $model->kd_aset4 ?? null,
                    $model->kd_aset5 ?? null,
                ], function ($v) {
                    return $v !== null && $v !== '';
                });

                if (!empty($parts)) {
                    $model->kode_barang = implode('.', $parts);
                }
            }
        });
    }

    /**
     * Relasi ke perawatan (jika ada)
     */
    public function perawatan()
    {
        // pastikan model Perawatan ada di App\Models\Perawatan
        return $this->hasMany(Perawatan::class, 'barang_id', 'id');
    }

    /**
     * Scope helper untuk cari barang berdasarkan nama / kode / nibar / reg
     */
    public function scopeSearch($query, ?string $term)
    {
        if (empty($term)) {
            return $query;
        }

        $term = '%' . trim($term) . '%';

        return $query->where(function ($q) use ($term) {
            $q->where('nama_barang', 'like', $term)
                ->orWhere('kode_barang', 'like', $term)
                ->orWhere('nibar', 'like', $term)
                ->orWhere('reg', 'like', $term)
                ->orWhere('merk', 'like', $term)
                ->orWhere('tipe', 'like', $term);
        });
    }

    /**
     * Scope helper untuk barang yang tersedia / tidak dihapus
     */
    public function scopeAvailable($query)
    {
        return $query->whereNull($this->getQualifiedDeletedAtColumn());
    }

    /**
     * Accessor: info lengkap (nama - merk tipe - lokasi)
     */
    public function getInfoLengkapAttribute()
    {
        $parts = [];
        $parts[] = $this->nama_barang;
        if ($this->merk) {
            $parts[] = $this->merk;
        }
        if ($this->tipe) {
            $parts[] = $this->tipe;
        }
        if ($this->nobar ?? false) {
            // keep for backwards compat if exists
        }

        $location = $this->lokasi ? ' (' . $this->lokasi . ')' : '';

        return implode(' - ', $parts) . $location;
    }

    /**
     * Accessor singkat untuk menampilkan nomor kendaraan (nopol + rangka + bpkb)
     */
    public function getInfoKendaraanAttribute()
    {
        $items = [];
        if ($this->nopol) $items[] = "Nopol: {$this->nopol}";
        if ($this->nomor_rangka) $items[] = "Rangka: {$this->nomor_rangka}";
        if ($this->nomor_bpkb) $items[] = "BPKB: {$this->nomor_bpkb}";

        return $items ? implode(' | ', $items) : null;
    }

    /**
     * Optional helper: hitung nilai_perolehan jika kosong (jumlah * harga_satuan)
     */
    public function calculateNilaiPerolehan(): ?int
    {
        if ($this->nilai_perolehan !== null) {
            return (int) $this->nilai_perolehan;
        }

        if ($this->harga_satuan !== null && $this->jumlah !== null) {
            return (int) ($this->harga_satuan * $this->jumlah);
        }

        return null;
    }
}
