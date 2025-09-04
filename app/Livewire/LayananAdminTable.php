<?php

namespace App\Livewire;

use App\Models\Layanan;
use Livewire\Component;
use Livewire\WithPagination;

class LayananAdminTable extends Component
{

    use WithPagination;

    public $nama_layanan = "";
    public $perPage = 10; // Tambahkan properti untuk jumlah item per halaman

    // Fungsi mount() tidak lagi diperlukan untuk inisialisasi awal.
    // Kita akan melakukan query di fungsi render()

    public function updatingNamaLayanan()
    {
        // Reset halaman ke-1 setiap kali properti nama_layanan diperbarui
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        // Reset halaman ke-1 setiap kali properti nama_layanan diperbarui
        $this->resetPage();
    }

    public function render()
    {
        // Pindahkan logika query ke sini
        $layanans = Layanan::query()
            ->where(function ($query) {
                $query->where('nama_layanan', 'like', '%' . $this->nama_layanan . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->nama_layanan . '%');
            })
            ->orderBy('created_at')
            ->paginate($this->perPage);

        return view('livewire.layanan-admin-table', [
            'layanans' => $layanans,
        ]);
    }
}
