<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class DokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen.
     */
    public function index()
    {
        $dokumens = Dokumen::latest()->paginate(10);
        return view('admin.dokumen.index', compact('dokumens'));
    }

    /**
     * Menampilkan form untuk menambahkan dokumen baru.
     */
    public function create()
    {
        return view('admin.dokumen.create');
    }

    /**
     * Menyimpan dokumen baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_dokumen' => 'required|in:Daftar Informasi Publik,Dokumen Keuangan,Dokumen Arsip',
            'tanggal_input' => 'required|date',
            'file_dokumen' => 'required|file|mimes:pdf|max:5120',
        ]);

        // Simpan ke storage/app/dokumen
        $path = $request->file('file_dokumen')->store('dokumen', 'public');

        

        $validated['file_path'] = $path;

        Dokumen::create($validated);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dokumen tertentu.
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.show', compact('dokumen'));
    }

    /**
     * Menampilkan form untuk mengedit dokumen tertentu.
     */
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    /**
     * Memperbarui dokumen tertentu.
     */
    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_dokumen' => 'required|in:Daftar Informasi Publik,Dokumen Keuangan,Dokumen Arsip',
            'tanggal_input' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama dari dua lokasi
            Storage::disk('public')->delete($dokumen->file_path);
            File::delete(public_path('storage/' . $dokumen->file_path));

            // Upload file baru
            $path = $request->file('file_dokumen')->store('dokumen', 'public');

            $from = storage_path('app/' . $path);
            $to = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($to));
            File::copy($from, $to);

            $validated['file_path'] = $path;
        }

        $dokumen->update($validated);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Menghapus dokumen tertentu.
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if ($dokumen->file_path) {
            Storage::delete($dokumen->file_path);
            File::delete(public_path('storage/' . $dokumen->file_path));
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function download($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Increment counter
        $dokumen->increment('download_count');

        $pathToFile = storage_path('app/' . $dokumen->file_path);
        if (!file_exists($pathToFile)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($pathToFile, $dokumen->judul . '.pdf');
    }

    public function dokumenPublik()
    {
        $dokumens = Dokumen::latest()->get();
        return view('dokumen', compact('dokumens'));
    }

}
