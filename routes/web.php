<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;

// == HALAMAN PUBLIK ==
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/berita', function () {
    return view('berita');
})->name('berita.index');

Route::get('/dokumen', function () {
    return view('dokumen');
})->name('dokumen.index');

Route::get('/permohonan-informasi', function () {
    return view('permohonan-informasi');
})->name('permohonan.create');

// == HALAMAN ADMIN ==
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- Route Resource untuk CRUD Dokumen Admin ---
    Route::resource('/admin/dokumen', DokumenController::class)->names('admin.dokumen');

});
