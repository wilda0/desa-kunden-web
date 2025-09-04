<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\BeritaMediaKonten;
use App\Models\Komentar;
use App\Models\ProdukUmkm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $beritas = Berita::when(
            request('tanggal'),
            fn($query) => $query->whereDate('tanggal', request('tanggal'))
        )->latest()->paginate(10);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'jenis' => 'required|string|in:Berita Desa,Pengumuman Desa,Pembangunan Desa,Kegiatan Desa',
            'deskripsi' => 'required|string'
        ]);

        Berita::create([
            'nama_berita' => $request->nama_berita,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'tanggal' => Carbon::now()->toDateString()
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
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
        $path = $request->file('media')->storeAs('berita-media', $newFilename, 'public');

        // Create the database record
        $media = BeritaMediaKonten::create([
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
        $medias = BeritaMediaKonten::whereIn("path", $request->url)->get()->keyBy("path");

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
        $media = BeritaMediaKonten::findOrFail($request->id);

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

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis' => 'required|string',
        ]);

        $berita->update($request->all());

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function auto_update(Request $request)
    {
        
        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis' => 'required|string',
            'id' => "required"
        ]);

        $berita = Berita::findOrFail($request->id);
        $berita->update($request->all());

        return response()->json([
            "message" => "menyimpan otomatis"
        ]);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
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
        $komentars = Komentar::where('berita_id', $id)->latest()->get();
        $produkUmkms = $berita->id == 6 ? ProdukUmkm::oldest()->get() : collect();

        return view('berita-detail', compact('berita', 'latestBeritas', 'komentars', 'produkUmkms'));
    }

    public function simpanKomentar(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'isi_komentar' => 'required|string|max:1000',
        ]);

        $validated['berita_id'] = $id;

        Komentar::create($validated);

        return back()->with('success', 'Komentar Anda berhasil dikirim!');
    }

    public function welcome()
    {
        $beritaDesa = Berita::where('jenis', 'Berita Desa')->latest()->limit(6)->get();
        $pengumumanDesa = Berita::where('jenis', 'Pengumuman Desa')->latest()->limit(6)->get();
        $pembangunanDesa = Berita::where('jenis', 'Pembangunan Desa')->latest()->limit(6)->get();

        return view('welcome', compact('beritaDesa', 'pengumumanDesa'));
    }
}
