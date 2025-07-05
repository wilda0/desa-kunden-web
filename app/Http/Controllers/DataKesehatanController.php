<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKesehatan;

class DataKesehatanController extends Controller
{
    public function index()
    {
        $data = DataKesehatan::latest()->first();
        return view('admin.data-kesehatan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bayi_lahir' => 'required|integer',
            'bayi_meninggal' => 'required|integer',
            'ibu_melahirkan' => 'required|integer',
            'ibu_meninggal' => 'required|integer',
            'jumlah_balita' => 'required|integer',
            'gizi_baik' => 'required|integer',
            'gizi_kurang' => 'required|integer',
            'gizi_buruk' => 'required|integer',
            'imunisasi_polio' => 'required|integer',
            'imunisasi_dpt1' => 'required|integer',
            'imunisasi_cacar' => 'required|integer',
            'sumur_galian' => 'required|integer',
            'air_pah' => 'required|integer',
            'sumur_pompa' => 'required|integer',
            'hidran_umum' => 'required|integer',
            'air_sungai' => 'required|integer',
        ]);

        DataKesehatan::create($validated);
        return redirect()->back()->with('success', 'Data kesehatan berhasil disimpan.');
    }

    public function showPublic()
    {
        $data = DataKesehatan::latest()->first();
        return view('data-kesehatan', compact('data'));
    }
}
