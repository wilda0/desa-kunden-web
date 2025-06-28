<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    public function publik(Request $request)
    {
        $query = InformasiPublik::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $kategoriList = InformasiPublik::select('kategori')->distinct()->pluck('kategori');

        $informasiPubliks = $query->latest()->paginate(10)->withQueryString();

        return view('informasi-publik', compact('informasiPubliks', 'kategoriList'));
    }

    public function index()
    {
        $data = InformasiPublik::latest()->paginate(10);
        return view('admin.informasi-publik.index', compact('data'));
    }

    public function create()
    {
        return view('admin.informasi-publik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_informasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:2000',
        ]);

        InformasiPublik::create($validated);
        return redirect()->route('admin.informasi-publik.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(InformasiPublik $informasiPublik)
    {
        return view('admin.informasi-publik.edit', compact('informasiPublik'));
    }

    public function update(Request $request, InformasiPublik $informasiPublik)
    {
        $validated = $request->validate([
            'judul_informasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|digits:4|integer|min:2000',
        ]);

        $informasiPublik->update($validated);
        return redirect()->route('admin.informasi-publik.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(InformasiPublik $informasiPublik)
    {
        $informasiPublik->delete();
        return back()->with('success', 'Informasi berhasil dihapus.');
    }
}
