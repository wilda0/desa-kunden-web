<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('data_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->integer('bayi_lahir');
            $table->integer('bayi_meninggal');
            $table->integer('ibu_melahirkan');
            $table->integer('ibu_meninggal');
            $table->integer('jumlah_balita');
            $table->integer('gizi_baik');
            $table->integer('gizi_kurang');
            $table->integer('gizi_buruk');
            $table->integer('imunisasi_polio');
            $table->integer('imunisasi_dpt1');
            $table->integer('imunisasi_cacar');
            $table->integer('sumur_galian');
            $table->integer('air_pah');
            $table->integer('sumur_pompa');
            $table->integer('hidran_umum');
            $table->integer('air_sungai');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('data_kesehatans');
    }
};
