<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
        ]);

        // Simpan file ke storage/app/public/galeri
        $path = $request->file('gambar')->store('galeri', 'public');

        // Copy manual ke public/storage/galeri biar langsung bisa diakses
        $source = storage_path('app/public/' . basename($path));
        $destination = public_path('storage/galeri/' . basename($path));

        // Buat folder tujuan kalau belum ada
        if (!file_exists(public_path('storage/galeri'))) {
            mkdir(public_path('storage/galeri'), 0755, true);
        }

        // Copy file
        copy($source, $destination);

        // Simpan path ke database
        $validated['gambar'] = 'galeri/' . basename($path);
        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage
            Storage::disk('public')->delete($galeri->gambar);

            // Simpan gambar baru ke storage/app/public/galeri
            $path = $request->file('gambar')->store('galeri', 'public');

            // Copy manual ke public/storage/galeri biar langsung bisa diakses
            $source = storage_path('app/public/' . basename($path));
            $destination = public_path('storage/galeri/' . basename($path));

            // Pastikan folder tujuan ada
            if (!file_exists(public_path('storage/galeri'))) {
                mkdir(public_path('storage/galeri'), 0755, true);
            }

            copy($source, $destination);

            // Simpan path ke database
            $validated['gambar'] = 'galeri/' . basename($path);
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function publik()
    {
        $galleryImages = Galeri::latest()->get();
        return view('galeri-desa', compact('galleryImages'));
    }
}
