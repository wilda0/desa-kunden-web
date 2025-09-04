<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AparaturController;
use App\Http\Controllers\ProdukHukumController;
use App\Http\Controllers\InformasiPublikController;
use App\Http\Controllers\ProdukUmkmController;
use App\Http\Controllers\DemografiKelaminController;
use App\Http\Controllers\DataPendidikanController;
use App\Http\Controllers\DataKesehatanController;
use App\Http\Controllers\DataKeagamaanController;
use App\Http\Controllers\DataEkonomiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LembagaController;
use App\Livewire\LembagaAdmin;
use App\Models\Berita;
use App\Models\Aparatur;
use App\Models\DataEkonomi;
use App\Models\DataKeagamaan;

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
Route::get('/', fn() => view('welcome'))->name('welcome');

// Profil Wilayah Desa
Route::get('/profil-wilayah', fn() => view('profil-wilayah-desa'))->name('profil-wilayah');

// Sejarah Desa
Route::get('/sejarah-desa', fn() => view('sejarah-desa'))->name('sejarah-desa');

// Kondisi Pemerintahan
Route::get('/kondisi-pemerintahan', fn() => view('kondisi-pemerintahan'))->name('kondisi-pemerintahan');

// Data Jenis Kelamin
Route::get('/data-jenis-kelamin', [DemografiKelaminController::class, 'showPublic'])->name('data-jenis-kelamin');

// Data Pendidikan
Route::get('/data-pendidikan', [DataPendidikanController::class, 'showPublic'])->name('data-pendidikan');

// Data Kesehatan
Route::get('/data-kesehatan', [DataKesehatanController::class, 'showPublic'])->name('data-kesehatan');

// Data Keagamaan
Route::get('/data-keagamaan', [DataKeagamaanController::class, 'showPublic'])->name('data-keagamaan');

// Data Ekonomi
Route::get('/data-ekonomi', [DataEkonomiController::class, 'showPublic'])->name('data-ekonomi');

// Berita Publik
Route::get('/berita', [BeritaController::class, 'publik'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');
Route::post('/berita/{id}/komentar', [BeritaController::class, 'simpanKomentar'])->name('berita.komentar');

// Permohonan Informasi
Route::get('/permohonan-informasi', fn() => view('permohonan-informasi'))->name('permohonan.create');
Route::post('/permohonan-informasi', [PermohonanController::class, 'store'])->name('permohonan.store');

// Dokumen Publik
Route::get('/dokumen', [DokumenController::class, 'dokumenPublik'])->name('dokumen.index');
Route::get('/unduh-dokumen/{id}', [DokumenController::class, 'download'])->name('dokumen.download');

// Galeri Desa
Route::get('/galeri-desa', [ GaleriController::class,"publik"])->name('galeri.index');

// Aparatur Desa
Route::get('/aparatur', fn() => view('aparatur'))->name('aparatur.index');

// Produk Hukum
Route::get('/produk-hukum', [ProdukHukumController::class, 'publik'])->name('produk-hukum.index');

// Informasi Publik
Route::get('/informasi-publik', [InformasiPublikController::class, 'publik'])->name('informasi-publik.index');
Route::get('/informasi-publik/detail/{id}', [InformasiPublikController::class, 'detail_publik'])->name('informasi-publik.detail');
// Layanan Desa Publik
Route::get('/layanan-desa', [LayananController::class, 'publik'])->name('layanan-desa');

// Lembaga Publik
Route::get('/lembaga-desa', [LembagaController::class, 'publik'])->name('lembaga-desa');
Route::get('/lembaga-desa-detail/{id}', [LembagaController::class, 'detail'])->name('lembaga-desa-detail');

// Produk UMKM
Route::get('/produk-umkm', [ProdukUmkmController::class, 'publik'])->name('produk-umkm.index');
Route::get('/produk-umkm/{produkUmkm}', [ProdukUmkmController::class, 'showPublik'])->name('produk-umkm.show');
Route::post('/produk-umkm/{id}/komentar', [ProdukUmkmController::class, 'simpanKomentar'])->name('produk-umkm.komentar.store');


Route::get("/get-token", function () {
    return csrf_token();
})->name('get-token');
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
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Layanan
    Route::resource('/admin/layanan', LayananController::class)->names('admin.layanan');

    // Lembaga
    Route::resource("/admin/lembaga",LembagaController::class)->names("admin.lembaga");
   
    // Data Jenis Kelamin
    Route::get('/admin/data-kelamin', [DemografiKelaminController::class, 'index'])->name('admin.data-kelamin.index');
    Route::post('/admin/data-kelamin', [DemografiKelaminController::class, 'store'])->name('admin.data-kelamin.store');

    // Data Pendidikan
    Route::get('/admin/data-pendidikan', [DataPendidikanController::class, 'index'])->name('admin.data-pendidikan.index');
    Route::post('/admin/data-pendidikan', [DataPendidikanController::class, 'store'])->name('admin.data-pendidikan.store');

    // Data Kesehatan
    Route::get('/admin/data-kesehatan', [DataKesehatanController::class, 'index'])->name('admin.data-kesehatan.index');
    Route::post('/admin/data-kesehatan', [DataKesehatanController::class, 'store'])->name('admin.data-kesehatan.store');

    // Data Keagamaan
    Route::get('/admin/data-keagamaan', [DataKeagamaanController::class, 'index'])->name('admin.data-keagamaan.index');
    Route::post('/admin/data-keagamaan', [DataKeagamaanController::class, 'store'])->name('admin.data-keagamaan.store');

    // Data Ekonomi
    Route::get('/admin/data-ekonomi', [DataEkonomiController::class, 'index'])->name('admin.data-ekonomi.index');
    Route::post('/admin/data-ekonomi', [DataEkonomiController::class, 'store'])->name('admin.data-ekonomi.store');

    // Dokumen Admin
    Route::resource('/admin/dokumen', DokumenController::class)->names('admin.dokumen');

    // Permohonan Informasi Admin
    Route::get('/admin/permohonan', [PermohonanController::class, 'index'])->name('admin.permohonan.index');
    Route::patch('/admin/permohonan/{id}/toggle', [PermohonanController::class, 'toggleStatus'])->name('admin.permohonan.toggle');

    // Berita Admin
    Route::resource('/admin/berita', BeritaController::class)->names('admin.berita');
    Route::post('admin/berita/upload-media', [BeritaController::class, 'upload_media_konten'])->name('berita.media.add');
    Route::post('admin/berita/remove-media', [BeritaController::class, 'remove_media_konten'])->name('berita.media.remove');
    Route::post('admin/berita/media-id', [BeritaController::class, 'get_media_id'])->name('berita.media.id');
    Route::post('admin/berita/auto-update', [BeritaController::class, 'auto_update'])->name('berita.media.auto_update');

    // Galeri Desa
    Route::resource('/admin/galeri', GaleriController::class)->names('admin.galeri');

    // Aparatur Desa
    Route::resource('/admin/aparatur', AparaturController::class)->names('admin.aparatur');

    // Produk Hukum
    Route::resource('/admin/produk-hukum', ProdukHukumController::class)->names('admin.produk-hukum');

    // Informasi Publik
    Route::resource('/admin/informasi-publik', InformasiPublikController::class)->names('admin.informasi-publik');
    Route::post('admin/informasi-publik/upload-media', [InformasiPublikController::class, 'upload_media_konten'])->name('informasi-publik.media.add');
    Route::post('admin/informasi-publik/remove-media', [InformasiPublikController::class, 'remove_media_konten'])->name('informasi-publik.media.remove');
    Route::post('admin/informasi-publik/media-id', [InformasiPublikController::class, 'get_media_id'])->name('informasi-publik.media.id');
    Route::post('admin/informasi-publik/auto-update', [InformasiPublikController::class, 'auto_update'])->name('informasi-publik.media.auto_update');

    // Produk UMKM
    Route::resource('/admin/produk-umkm', ProdukUmkmController::class)->names('admin.produk-umkm');
});
