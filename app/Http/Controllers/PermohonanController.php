<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'telepon' => [
                'required',
                'regex:/^08[0-9]{7,11}$/',
            ],
            'email' => 'required|email',
            'permohonan' => 'required|string',
        ], [
            'telepon.regex' => 'Nomor telepon harus dimulai dengan 08 dan terdiri dari 9 hingga 13 digit angka.',
            'email.email' => 'Format email tidak valid. Harus menyertakan "@" dan domain.',
        ]);

        Permohonan::create($request->all());

        return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');
    }

    public function index()
    {
        $permohonans = Permohonan::latest()->paginate(10);
        return view('admin.permohonan.index', compact('permohonans'));
    }

    public function toggleStatus($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = !$permohonan->status;
        $permohonan->save();

        return back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

}
