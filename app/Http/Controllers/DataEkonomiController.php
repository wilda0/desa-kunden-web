<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataEkonomi;
use Illuminate\Http\Request;

class DataEkonomiController extends Controller
{
    public function index()
    {
        $data = DataEkonomi::latest()->first();
        return view('admin.data-ekonomi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'padi_sawah' => 'required|integer|min:0',
            'padi_ladang' => 'required|integer|min:0',
            'jagung' => 'required|integer|min:0',
            'palawija' => 'required|integer|min:0',
            'tebu' => 'required|integer|min:0',
            'kambing' => 'required|integer|min:0',
            'sapi' => 'required|integer|min:0',
            'ayam' => 'required|integer|min:0',
            'burung' => 'required|integer|min:0',
            'petani' => 'required|integer|min:0',
            'pedagang' => 'required|integer|min:0',
            'pns' => 'required|integer|min:0',
            'tukang' => 'required|integer|min:0',
            'guru' => 'required|integer|min:0',
            'bidan_perawat' => 'required|integer|min:0',
            'tni_polri' => 'required|integer|min:0',
            'pensiunan' => 'required|integer|min:0',
            'sopir_angkutan' => 'required|integer|min:0',
            'buruh' => 'required|integer|min:0',
            'jasa_persewaan' => 'required|integer|min:0',
            'swasta' => 'required|integer|min:0',
        ]);

        DataEkonomi::create($validated);
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function showPublic()
    {
        $data = DataEkonomi::latest()->first();
        return view('data-ekonomi', compact('data'));
    }
}
