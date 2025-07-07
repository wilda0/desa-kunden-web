<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use App\Models\Komentar;
use App\Models\ProdukUmkm;
use Illuminate\Support\Facades\File;

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
        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jenis' => 'required|string|in:Berita Desa,Pengumuman Desa,Pembangunan Desa,Kegiatan Desa',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:2048',
        ]);

        $path = $request->file('foto')->store('berita', 'public');
        $source = storage_path('app/public/' . $path);
        $destination = public_path('storage/' . $path);
        File::ensureDirectoryExists(dirname($destination));
        File::copy($source, $destination);

        Berita::create([
            'nama_berita' => $request->nama_berita,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
        ]);

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

        $request->validate([
            'nama_berita' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama_berita', 'tanggal', 'deskripsi']);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($berita->foto);
            File::delete(public_path('storage/' . $berita->foto));

            $path = $request->file('foto')->store('berita', 'public');
            $source = storage_path('app/public/' . $path);
            $destination = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);

            $data['foto'] = $path;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
            File::delete(public_path('storage/' . $berita->foto));
        }

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
