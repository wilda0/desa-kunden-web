<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource (admin).
     */
    public function index()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'media' => 'required|array',
            'media.*' => 'mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:125829120',
            'judul_media' => 'required'
        ]);

        $titles = json_decode($request->judul_media, true);
        $dataToInsert = [];

        foreach ($request->file('media') as $index => $file) {
            $title = $titles[$index] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $safeName = Str::slug($filename) . '_' . time() . '.' . $extension;

            // Store the file in the 'galeri' subdirectory of the 'public' disk
            $path = $file->storeAs('galeri', $safeName, 'public');

            $dataToInsert[] = [
                'gambar' => $path, // relative path in storage
                'judul' => $title,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Galeri::insert($dataToInsert);

        return redirect()->route('admin.galeri.index')->with('success', 'Media galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old file
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }

            // Store new file
            $path = $request->file('gambar')->store('galeri', 'public');
            $validated['gambar'] = $path;
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Delete file from storage
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Display gallery for public page (frontend).
     */
    public function publik()
    {
        $galleryImages = Galeri::latest()->paginate(12); // show 12 per page
        return view('galeri-desa', compact('galleryImages'));
    }
}
