<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aparatur;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AparaturController extends Controller
{
    public function index()
    {
        $aparatur = Aparatur::latest()->paginate(10);
        return view('admin.aparatur.index', compact('aparatur'));
    }

    public function create()
    {
        return view('admin.aparatur.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'required|image|max:2048',
        ]);

        $path = $request->file('foto')->store('aparatur', 'public');

        // Copy ke public/storage/aparatur/
        $source = storage_path('app/public/' . $path);
        $destination = public_path('storage/' . $path);
        File::ensureDirectoryExists(dirname($destination));
        File::copy($source, $destination);

        $validated['foto'] = $path;

        Aparatur::create($validated);

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aparatur = Aparatur::findOrFail($id);
        return view('admin.aparatur.edit', compact('aparatur'));
    }

    public function update(Request $request, $id)
    {
        $aparatur = Aparatur::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($aparatur->foto && Storage::disk('public')->exists($aparatur->foto)) {
                Storage::disk('public')->delete($aparatur->foto);
                File::delete(public_path('storage/' . $aparatur->foto));
            }

            $path = $request->file('foto')->store('aparatur', 'public');

            // Copy ke public/storage/aparatur/
            $source = storage_path('app/public/' . $path);
            $destination = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);

            $validated['foto'] = $path;
        }

        $aparatur->update($validated);

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aparatur = Aparatur::findOrFail($id);
        Storage::disk('public')->delete($aparatur->foto);
        $aparatur->delete();

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil dihapus.');
    }
}
