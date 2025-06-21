<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('jenis_dokumen', ['Daftar Informasi Publik', 'Dokumen Keuangan', 'Dokumen Arsip']);
            $table->date('tanggal_input');
            $table->string('file_path'); // Untuk menyimpan path file PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
