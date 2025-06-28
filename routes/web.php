<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Ini adalah file routing utama untuk aplikasi web.
| Rute dibagi menjadi:
| 1. Halaman Publik
| 2. Halaman Admin (dengan middleware autentikasi)
*/

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('welcome');

// Berita Publik
Route::get('/berita', [BeritaController::class, 'publik'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');
Route::post('/berita/{id}/komentar', [BeritaController::class, 'simpanKomentar'])->name('berita.komentar');

// Permohonan Informasi
Route::get('/permohonan-informasi', fn () => view('permohonan-informasi'))->name('permohonan.create');
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');

// Dokumen Publik
Route::get('/dokumen', [DokumenController::class, 'dokumenPublik'])->name('dokumen.index');
Route::get('/unduh-dokumen/{id}', [DokumenController::class, 'download'])->name('dokumen.download');

// Galeri Desa
Route::get('/galeri-desa', fn() => view('galeri-desa'))->name('galeri.index');

/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Dokumen Admin
    Route::resource('/admin/dokumen', DokumenController::class)->names('admin.dokumen');

    // Permohonan Informasi Admin
    Route::get('/admin/permohonan', [PermohonanController::class, 'index'])->name('admin.permohonan.index');
    Route::patch('/admin/permohonan/{id}/toggle', [PermohonanController::class, 'toggleStatus'])->name('admin.permohonan.toggle');

    // Berita Admin
    Route::resource('/admin/berita', BeritaController::class)->names('admin.berita');

    // Galeri Desa
    Route::resource('/admin/galeri', GaleriController::class)->names('admin.galeri');
});
