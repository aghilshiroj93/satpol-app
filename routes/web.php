<?php

use App\Http\Controllers\AuthPetugasController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Login routes harus di luar middleware auth.
| Resource & dashboard routes ditempatkan di dalam group auth supaya aman.
|
*/

// Public auth routes (pastikan ini DI LUAR group auth)
Route::get('/login', [AuthPetugasController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthPetugasController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthPetugasController::class, 'logout'])->name('logout');

// Root: arahkan ke dashboard kalau sudah login, kalau belum ke login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Protected routes: hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Endpoint tambahan untuk data perawatan (AJAX)
    Route::get('/dashboard/perawatan-data', [DashboardController::class, 'getPerawatanData'])
        ->name('dashboard.perawatan-data');

    // Resource routes
    Route::resource('barang', BarangController::class);
    // Jika kamu butuh route detail khusus
    Route::get('/barang/{barang}/detail', [BarangController::class, 'detail'])
        ->name('barang.detail');

    Route::resource('perawatan', PerawatanController::class);
    Route::resource('petugas', PetugasController::class);
});
