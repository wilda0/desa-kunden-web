<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('generate:sitemap', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/profil-desa'))
        ->add(Url::create('/berita'))
        ->add(Url::create('/galeri'))
        ->add(Url::create('/kontak'))
        ->writeToFile(public_path('sitemap.xml'));

    $this->info('✅ Sitemap berhasil dibuat di public/sitemap.xml');
})->purpose('Generate sitemap XML untuk SEO');
