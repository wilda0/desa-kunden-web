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
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('jenis')->default('Berita Desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};
