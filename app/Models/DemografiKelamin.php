<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemografiKelamin extends Model
{
    use HasFactory;

    protected $fillable = [
        'laki_laki',
        'perempuan',
        'kepala_keluarga',
    ];
}
