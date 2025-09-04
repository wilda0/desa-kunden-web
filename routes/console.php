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
        ->add(Url::create('https://kunden.id/'))
        ->add(Url::create('https://kunden.id/profil-desa'))
        ->add(Url::create('https://kunden.id/berita'))
        ->add(Url::create('https://kunden.id/galeri'))
        ->add(Url::create('https://kunden.id/kontak'))
        ->writeToFile(public_path('sitemap.xml'));

    $this->info('✅ Sitemap berhasil dibuat di sitemap.xml');
})->purpose('Generate sitemap XML untuk SEO');
