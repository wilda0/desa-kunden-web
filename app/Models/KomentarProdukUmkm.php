<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarProdukUmkm extends Model
{

    use HasFactory;
    protected $fillable = [
        'produk_umkm_id',
        'nama',
        'email',
        'isi_komentar'
    ];

    public function produkUmkm()
    {
        return $this->belongsTo(ProdukUmkm::class);
    }
}
