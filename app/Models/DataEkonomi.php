<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEkonomi extends Model
{
    use HasFactory;

    protected $table = 'data_ekonomis';

    protected $fillable = [
        // Tanaman Pertanian
        'padi_sawah',
        'padi_ladang',
        'jagung',
        'palawija',
        'tebu',

        // Jenis Ternak
        'kambing',
        'sapi',
        'ayam',
        'burung',

        // Mata Pencaharian
        'petani',
        'pedagang',
        'pns',
        'tukang',
        'guru',
        'bidan_perawat',
        'tni_polri',
        'pensiunan',
        'sopir_angkutan',
        'buruh',
        'jasa_persewaan',
        'swasta'
    ];
}
