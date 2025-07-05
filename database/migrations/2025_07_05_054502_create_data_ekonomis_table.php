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
        Schema::create('data_ekonomis', function (Blueprint $table) {
            $table->id();
            // Tanaman
            $table->integer('padi_sawah')->default(0);
            $table->integer('padi_ladang')->default(0);
            $table->integer('jagung')->default(0);
            $table->integer('palawija')->default(0);
            $table->integer('tebu')->default(0);
            // Ternak
            $table->integer('kambing')->default(0);
            $table->integer('sapi')->default(0);
            $table->integer('ayam')->default(0);
            $table->integer('burung')->default(0);
            // Pekerjaan
            $table->integer('petani')->default(0);
            $table->integer('pedagang')->default(0);
            $table->integer('pns')->default(0);
            $table->integer('tukang')->default(0);
            $table->integer('guru')->default(0);
            $table->integer('bidan_perawat')->default(0);
            $table->integer('tni_polri')->default(0);
            $table->integer('pensiunan')->default(0);
            $table->integer('sopir_angkutan')->default(0);
            $table->integer('buruh')->default(0);
            $table->integer('jasa_persewaan')->default(0);
            $table->integer('swasta')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ekonomis');
    }
};
