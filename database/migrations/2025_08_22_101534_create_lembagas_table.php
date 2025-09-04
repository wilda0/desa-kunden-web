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
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->string("nama_lembaga");
            $table->enum("tipe_lembaga",["Tidak Diketahui","Ekonomi","Pemberdayaan","Pendidikan","Keagamaan","Sosial","Kesehatan","Pemerintahan","Masyarakat"])->default("Masyarakat");
            $table->longText("deskripsi");
            $table->year("tahun_berdiri");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembagas');
    }
};
