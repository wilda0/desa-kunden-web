<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $beritas = Berita::when(request('tanggal'), fn($query) =>
            $query->whereDate('tanggal', request('tanggal'))
        )->latest()->paginate(10);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_berita' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:2048',
        ]);

        $validated['foto'] = $request->file('foto')->store('berita', 'public');

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'nama_berita' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($berita->foto);
            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        Storage::disk('public')->delete($berita->foto);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    public function publik()
    {
        $beritas = Berita::latest()->paginate(6);
        return view('berita', compact('beritas'));
    }

    public function detail($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->increment('views');
        $latestBeritas = Berita::where('id', '!=', $id)->latest()->limit(5)->get();

        return view('berita-detail', compact('berita', 'latestBeritas'));
    }

}
