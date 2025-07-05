<?php

namespace App\Http\Controllers;

use App\Models\DataKeagamaan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDataKeagamaanRequest;
use App\Http\Requests\UpdateDataKeagamaanRequest;

class DataKeagamaanController extends Controller
{
    public function index()
    {
        $data = DataKeagamaan::latest()->first();
        return view('admin.data-keagamaan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'islam' => 'required|integer',
            'katolik' => 'required|integer',
            'kristen' => 'required|integer',
            'hindu' => 'required|integer',
            'budha' => 'required|integer',
            'kepercayaan' => 'required|integer',
            'masjid' => 'required|integer',
            'gereja' => 'required|integer',
            'pura' => 'required|integer',
            'vihara' => 'required|integer',
        ]);

        DataKeagamaan::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function showPublic()
    {
        $data = DataKeagamaan::latest()->first();
        return view('data-keagamaan', compact('data'));
    }
}
