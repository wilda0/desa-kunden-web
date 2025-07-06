<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        // Simpan ke storage/app/public/galeri
        $path = $request->file('gambar')->store('galeri', 'public');

        // Salin ke public/storage/galeri agar bisa diakses publik
        $from = storage_path('app/public/' . $path);
        $to = public_path('storage/' . $path);
        File::ensureDirectoryExists(dirname($to));
        File::copy($from, $to);

        $validated['gambar'] = $path;

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
            // Hapus gambar lama
            Storage::disk('public')->delete($galeri->gambar);
            File::delete(public_path('storage/' . $galeri->gambar));

            // Simpan gambar baru
            $path = $request->file('gambar')->store('galeri', 'public');

            // Salin ke public
            $from = storage_path('app/public/' . $path);
            $to = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($to));
            File::copy($from, $to);

            $validated['gambar'] = $path;
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
