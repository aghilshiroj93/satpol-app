<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangController as ControllersBarangController;
use App\Http\Controllers\PerawatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.home');
})->name('dashboard');

Route::resource('barang', BarangController::class);
Route::get('/barang/{id}/detail', [BarangController::class, 'detail'])
    ->name('barang.detail');

    Route::resource('perawatan', PerawatanController::class);