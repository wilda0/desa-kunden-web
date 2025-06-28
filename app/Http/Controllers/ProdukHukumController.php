<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukHukumController extends Controller
{
    public function index()
    {
        $produkHukums = ProdukHukum::latest()->paginate(10);
        return view('admin.produk-hukum.index', compact('produkHukums'));
    }

    public function create()
    {
        return view('admin.produk-hukum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_hukum' => 'required|string|max:255',
            'jenis_hukum' => 'required|string|max:100',
            'tahun' => 'required|digits:4|integer',
        ]);

        ProdukHukum::create($validated);

        return redirect()->route('admin.produk-hukum.index')->with('success', 'Produk Hukum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);
        return view('admin.produk-hukum.edit', compact('produkHukum'));
    }

    public function update(Request $request, $id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);

        $validated = $request->validate([
            'judul_hukum' => 'required|string|max:255',
            'jenis_hukum' => 'required|string|max:100',
            'tahun' => 'required|digits:4|integer',
        ]);

        $produkHukum->update($validated);

        return redirect()->route('admin.produk-hukum.index')->with('success', 'Produk Hukum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);
        $produkHukum->delete();

        return redirect()->route('admin.produk-hukum.index')->with('success', 'Produk Hukum berhasil dihapus.');
    }

    public function publik(Request $request)
    {
        $query = ProdukHukum::query();

        if ($request->filled('jenis_hukum')) {
            $query->where('jenis_hukum', $request->jenis_hukum);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $jenisHukumList = ProdukHukum::select('jenis_hukum')->distinct()->pluck('jenis_hukum');
        $tahunList = ProdukHukum::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        $produkHukums = $query->latest()->paginate(10)->withQueryString();

        return view('produk-hukum', compact('produkHukums', 'jenisHukumList', 'tahunList'));
    }
}
