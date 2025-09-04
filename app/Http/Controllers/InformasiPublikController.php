<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use App\Models\MediaInformasiPublik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

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
    public function upload_media_konten(Request $request)
    {
        $request->validate([
            'media' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,gif,mp4,mov,avi',
                'max:204800', // 200MB
            ]
        ]);

        // Get the original filename and extension
        $originalFilename = $request->file('media')->getClientOriginalName();
        $extension = $request->file('media')->getClientOriginalExtension();

        // Generate a new unique filename
        $newFilename = time() . '_' . Str::random(10) . '.' . $extension;

        // Store the file with the new filename in the 'berita-media' subdirectory
        $path = $request->file('media')->storeAs('Informasi-publik', $newFilename, 'public');

        // Create the database record
        $media = MediaInformasiPublik::create([
            'filename' => $originalFilename, // You might want to save the original filename for display
            'path' => $path // Save the new file's path
        ]);

        return response()->json([
            "filename" => $originalFilename,
            "path" => $path,
            "url" => asset('storage/' . $path),
            "id" => $media->id,
            "type" => "ADD"
        ]);
    }

    public function get_media_id(Request $request)
    {
        $request->validate([
            "url" => "required|array", // make sure it's an array
            "url.*" => "string"        // each item must be a string
        ]);

        // Get all medias from DB keyed by path for fast lookup
        $medias = MediaInformasiPublik::whereIn("path", $request->url)->get()->keyBy("path");

        // Map each requested URL and attach id if exists
        $results = collect($request->url)->map(function ($url) use ($medias) {
            $media = $medias->get($url);

            return [
                "url" => $url,
                "id" => $media?->id,
                "exists" => $media !== null,
            ];
        });

        return response()->json($results);
    }


    public function remove_media_konten(Request $request)
    {
        $request->validate([
            "id" => "required"
        ]);
        $media = MediaInformasiPublik::findOrFail($request->id);

        // Use the Storage facade to delete the file from the public disk
        if ($media->path && Storage::disk('public')->exists($media->path)) {
            Storage::disk('public')->delete($media->path);
        }

        $media->delete();

        return response()->json([
            "filename" => $media->filename . " berhasil di hapus ",
            "type" => "REMOVE"
        ]);
    }
    public function auto_update(Request $request)
    {

        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis' => 'required|string',
            'id' => "required"
        ]);

        $berita = MediaInformasiPublik::findOrFail($request->id);
        $berita->update($request->all());

        return response()->json([
            "message" => "menyimpan otomatis"
        ]);
    }
    public function detail_publik(String $id){
        $informasi=InformasiPublik::findOrFail($id);
        return view("informasi-publik-detail",compact("informasi"));
    } 

}
