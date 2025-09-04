<?php

namespace App\Livewire;

use App\Models\Layanan;
use App\Models\Lembaga;
use Livewire\Component;
use Livewire\WithPagination;

class LembagaTable extends Component
{

    use WithPagination;

    public $nama_lembaga = "";
    public $perPage = 10; // Tambahkan properti untuk jumlah item per halaman

    // Fungsi mount() tidak lagi diperlukan untuk inisialisasi awal.
    // Kita akan melakukan query di fungsi render()

    public function updatingNamaLayanan()
    {
        // Reset halaman ke-1 setiap kali properti nama_lembaga diperbarui
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        // Reset halaman ke-1 setiap kali properti nama_lembaga diperbarui
        $this->resetPage();
    }

    public function render()
    {
        // Pindahkan logika query ke sini
        $lembagas = Lembaga::query()
            ->where(function ($query) {
                $query->where('nama_lembaga', 'like', '%' . $this->nama_lembaga . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->nama_lembaga . '%');
            })
            ->orderBy('created_at')
            ->paginate($this->perPage);

        return view('livewire.lembaga-table', [
            'lembagas' => $lembagas,
        ]);
    }
}
