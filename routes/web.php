<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\BeritaController;

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

Route::get('/berita', fn () => view('berita'))->name('berita.index');
Route::get('/permohonan-informasi', fn () => view('permohonan-informasi'))->name('permohonan.create');

// Dokumen Publik
Route::get('/dokumen', [DokumenController::class, 'dokumenPublik'])->name('dokumen.index');
Route::get('/unduh-dokumen/{id}', [DokumenController::class, 'download'])->name('dokumen.download');
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');

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

    // Dashboard Admin
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // CRUD Dokumen (Admin)
    Route::resource('/admin/dokumen', DokumenController::class)->names('admin.dokumen');

    // Dashboard permohonan
    Route::get('/admin/permohonan', [PermohonanController::class, 'index'])->name('admin.permohonan.index');
    Route::patch('/admin/permohonan/{id}/toggle', [PermohonanController::class, 'toggleStatus'])->name('admin.permohonan.toggle');

    Route::resource('/admin/berita', BeritaController::class)->names('admin.berita');
});
