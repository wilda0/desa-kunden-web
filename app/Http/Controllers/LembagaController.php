<?php

namespace App\Http\Controllers;

use App\Enums\TipeLembaga;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.lembaga.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semua_lembaga = TipeLembaga::cases();
        return view("admin.lembaga.create",compact("semua_lembaga"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama_lembaga" => "required",
            "tipe_lembaga" => "required",
            "deskripsi" => "required",
            "tahun_berdiri" => "required"
        ], [
            "nama_lembaga" => "Nama Lembaga wajib di isi",
            "tipe_lembaga" => "Tipe Lembaga Wajib di isi",
            "deskripsi" => "Deskripsi Wajib di isi",
            "tahun_berdiri" => "Tahun Berdiri Wajib di isi"
        ]);

        Lembaga::create($request->all());
        return redirect()->route("admin.lembaga.index")->with("success","Berhasil menambahkan lembaga");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);
        return view("admin.lembaga.show",compact("lembaga"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $semua_lembaga = TipeLembaga::cases();
        $lembaga = Lembaga::findOrFail($id);
        return view("admin.lembaga.edit",compact("lembaga","semua_lembaga"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nama_lembaga" => "required",
            "tipe_lembaga" => "required",
            "deskripsi" => "required",
            "tahun_berdiri" => "required"
        ], [
            "nama_lembaga" => "Nama Lembaga wajib di isi",
            "tipe_lembaga" => "Tipe Lembaga Wajib di isi",
            "deskripsi" => "Deskripsi Wajib di isi",
            "tahun_berdiri" => "Tahun Berdiri Wajib di isi"
        ]);

        $lembaga = Lembaga::findOrFail($id);
        $lembaga->update($request->all());
        return redirect()->route("admin.lembaga.index")->with("success","Berhasil mengupdate lembaga");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lembaga = Lembaga::findOrFail($id);
        $lembaga->delete();
        return redirect()->route("admin.lembaga.index")->with("success","Berhasil menghapus lembaga");
    }

    public function publik(){
        return view("lembaga-desa");
    }

    public function detail(string $id){
        $lembaga = Lembaga::findOrFail($id);
        return view("lembaga-desa-detail",compact("lembaga"));
    }
}
