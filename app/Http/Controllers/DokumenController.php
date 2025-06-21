<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_dokumen' => 'required|in:Daftar Informasi Publik,Dokumen Keuangan,Dokumen Arsip',
            'tanggal_input' => 'required|date',
            'file_dokumen' => 'required|file|mimes:pdf|max:5120',
        ]);

        $filePath = $request->file('file_dokumen')->store('dokumen', 'public');

        Dokumen::create([
            'judul' => $request->judul,
            'jenis_dokumen' => $request->jenis_dokumen,
            'tanggal_input' => $request->tanggal_input,
            'file_path' => $filePath,
        ]);

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_dokumen' => 'required|in:Daftar Informasi Publik,Dokumen Keuangan,Dokumen Arsip',
            'tanggal_input' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $dokumen = Dokumen::findOrFail($id);

        $data = $request->except('file_dokumen');

        if ($request->hasFile('file_dokumen')) {
            if ($dokumen->file_path && Storage::exists($dokumen->file_path)) {
                Storage::delete($dokumen->file_path);
            }

            $data['file_path'] = $request->file('file_dokumen')->store('public/dokumen');
        }

        $dokumen->update($data);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Menghapus dokumen tertentu.
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if ($dokumen->file_path && Storage::exists($dokumen->file_path)) {
            Storage::delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
