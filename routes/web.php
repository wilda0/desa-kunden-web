<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // <-- Tambahkan ini

// Route untuk menampilkan halaman daftar semua berita
Route::get('/berita', function () {
    // Nantinya, di sini Anda bisa mengambil data dari database berita
    return view('berita'); // Ini akan memuat file `resources/views/berita.blade.php`
})->name('berita.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
