<?php

namespace App\Enums;

enum TipeLembaga : string{
    case Ekonomi = "Ekonomi";
    case Pemberdayaan = "Pemberdayaan";
    case Pendidikan = "Pendidikan";
    case Keagamaan = "Keagamaan";
    case Sosial = "Sosial";
    case Kesehatan = "Kesehatan";
    case Pemerintahan = "Pemerintahan";
    case Masyarakat = "Masyarakat";
    case Tidak_Diketahui = "Tidak Diketahui";
};