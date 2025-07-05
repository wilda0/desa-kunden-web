<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeagamaan extends Model
{
    use HasFactory;

    protected $table = 'data_keagamaans';

    protected $fillable = [
        'islam',
        'katolik',
        'kristen',
        'hindu',
        'budha',
        'kepercayaan',
        'masjid',
        'gereja',
        'pura',
        'vihara',
    ];
}
