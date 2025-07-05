<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sd_mi',
        'sltp_mts',
        'slta_ma',
        's1_diploma',
        'putus_sekolah',
        'buta_huruf',
        'gedung_tk_paud',
        'gedung_sd_mi',
        'gedung_sltp_mts',
    ];
}
