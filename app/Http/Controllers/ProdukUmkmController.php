<?php

namespace App\Http\Controllers;

use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\KomentarProdukUmkm;

class ProdukUmkmController extends Controller
{
    public function index()
    {
        $produkUmkms = ProdukUmkm::latest()->paginate(10);
        return view('admin.produk-umkm.index', compact('produkUmkms'));
    }

    public function create()
    {
        return view('admin.produk-umkm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|max:2048',
            'format_harga' => 'required|string|max:100',
            'nomor_wa' => 'nullable|string|max:20',
        ]);

        $path = $request->file('foto')->store('produk-umkm', 'public');

        $source = storage_path('app/public/' . $path);
        $destination = public_path('storage/' . $path);
        File::ensureDirectoryExists(dirname($destination));
        File::copy($source, $destination);

        ProdukUmkm::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'format_harga' => $request->format_harga,
            'nomor_wa' => $request->nomor_wa,
        ]);

        return redirect()->route('admin.produk-umkm.index')->with('success', 'Produk UMKM berhasil ditambahkan.');
    }

    public function edit(ProdukUmkm $produkUmkm)
    {
        return view('admin.produk-umkm.edit', compact('produkUmkm'));
    }

    public function update(Request $request, ProdukUmkm $produkUmkm)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:2048',
            'format_harga' => 'required|string|max:100',
            'nomor_wa' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['nama_produk', 'format_harga', 'deskripsi', 'nomor_wa']);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($produkUmkm->foto);
            File::delete(public_path('storage/' . $produkUmkm->foto));

            $path = $request->file('foto')->store('produk-umkm', 'public');
            $source = storage_path('app/public/' . $path);
            $destination = public_path('storage/' . $path);
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);

            $data['foto'] = $path;
        }

        $produkUmkm->update($data);

        return redirect()->route('admin.produk-umkm.index')->with('success', 'Produk UMKM berhasil diperbarui.');
    }

    public function destroy(ProdukUmkm $produkUmkm)
    {
        if ($produkUmkm->foto) {
            Storage::disk('public')->delete($produkUmkm->foto);
            File::delete(public_path('storage/' . $produkUmkm->foto));
        }

        $produkUmkm->delete();
        return redirect()->route('admin.produk-umkm.index')->with('success', 'Produk UMKM berhasil dihapus.');
    }

    public function publik(Request $request)
    {
        $query = ProdukUmkm::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $produkUmkms = $query->latest()->paginate(12)->withQueryString();

        return view('produk-umkm', compact('produkUmkms'));
    }

    public function showPublik(ProdukUmkm $produkUmkm)
    {
        $produkUmkm->load('komentars');
        return view('produk-umkm-detail', compact('produkUmkm'));
    }

    public function simpanKomentar(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'isi_komentar' => 'required|string|max:1000',
        ]);

        KomentarProdukUmkm::create([
            'produk_umkm_id' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar Anda berhasil dikirim!');
    }
}
