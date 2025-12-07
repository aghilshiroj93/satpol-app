<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangController as ControllersBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerawatanController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/perawatan-data', [DashboardController::class, 'getPerawatanData'])
    ->name('dashboard.perawatan-data');


Route::resource('barang', BarangController::class);
Route::get('/barang/{id}/detail', [BarangController::class, 'detail'])
    ->name('barang.detail');

    Route::resource('perawatan', PerawatanController::class);