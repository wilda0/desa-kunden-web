<?php

namespace App\Http\Controllers;

use App\Models\DemografiKelamin;
use Illuminate\Http\Request;

class DemografiKelaminController extends Controller
{
    public function index()
    {
        $data = DemografiKelamin::latest()->first();
        return view('admin.demografi-kelamin.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'kepala_keluarga' => 'required|integer|min:0',
        ]);

        DemografiKelamin::create([
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'kepala_keluarga' => $request->kepala_keluarga,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function showPublic()
    {
        $data = DemografiKelamin::latest()->first();
        return view('data-jenis-kelamin', compact('data'));
    }
}
