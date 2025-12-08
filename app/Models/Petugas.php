<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    // Jika kamu menggunakan table bernama 'petugas' (bukan 'petugases' atau default)
    protected $table = 'petugas';

    // UUID primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
    ];

    // Sembunyikan password saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika mau cast timestamps atau lainnya, tambahkan di sini
    // protected $casts = [...];
}
