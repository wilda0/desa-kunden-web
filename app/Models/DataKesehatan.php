<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bayi_lahir',
        'bayi_meninggal',
        'ibu_melahirkan',
        'ibu_meninggal',
        'jumlah_balita',
        'gizi_baik',
        'gizi_kurang',
        'gizi_buruk',
        'imunisasi_polio',
        'imunisasi_dpt1',
        'imunisasi_cacar',
        'sumur_galian',
        'air_pah',
        'sumur_pompa',
        'hidran_umum',
        'air_sungai'
    ];
}
