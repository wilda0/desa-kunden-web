<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_hukum',
        'jenis_hukum',
        'tahun'
    ];
}
