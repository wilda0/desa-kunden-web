<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->integer('sd_mi');
            $table->integer('sltp_mts');
            $table->integer('slta_ma');
            $table->integer('s1_diploma');
            $table->integer('putus_sekolah');
            $table->integer('buta_huruf');
            $table->integer('gedung_tk_paud');
            $table->integer('gedung_sd_mi');
            $table->integer('gedung_sltp_mts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pendidikans');
    }
};
