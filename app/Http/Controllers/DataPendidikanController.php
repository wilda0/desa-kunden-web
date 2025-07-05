<?php

namespace App\Http\Controllers;

use App\Models\DataPendidikan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDataPendidikanRequest;
use App\Http\Requests\UpdateDataPendidikanRequest;

class DataPendidikanController extends Controller
{
    public function index()
    {
        $data = DataPendidikan::latest()->first();
        return view('admin.data-pendidikan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sd_mi' => 'required|integer|min:0',
            'sltp_mts' => 'required|integer|min:0',
            'slta_ma' => 'required|integer|min:0',
            's1_diploma' => 'required|integer|min:0',
            'putus_sekolah' => 'required|integer|min:0',
            'buta_huruf' => 'required|integer|min:0',
            'gedung_tk_paud' => 'required|integer|min:0',
            'gedung_sd_mi' => 'required|integer|min:0',
            'gedung_sltp_mts' => 'required|integer|min:0',
        ]);

        DataPendidikan::create($validated);

        return back()->with('success', 'Data berhasil disimpan!');
    }

    public function showPublic()
    {
        $data = DataPendidikan::latest()->first();
        return view('data-pendidikan', compact('data'));
    }
}
