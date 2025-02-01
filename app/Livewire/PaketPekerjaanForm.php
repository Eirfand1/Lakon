<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubKegiatan;
use App\Models\DasarHukum;

class PaketPekerjaanForm extends Component
{
    public $subKegiatanList; // Daftar sub kegiatan dari database
    public $dasarHukumList;  // Daftar dasar hukum dari database
    public $subKegiatanInputs = []; // Input sub kegiatan yang ditambahkan oleh pengguna
    public $dasarHukumInputs = [];  // Input dasar hukum yang ditambahkan oleh pengguna

    public function mount()
    {
        // Ambil data sub kegiatan dan dasar hukum dari database
        $this->subKegiatanList = SubKegiatan::all();
        $this->dasarHukumList = DasarHukum::all();
    }

    // Tambah input sub kegiatan baru
    public function addSubKegiatanInput()
    {
        $this->subKegiatanInputs[] = ['sub_kegiatan_id' => ''];
    }

    // Hapus input sub kegiatan
    public function removeSubKegiatanInput($index)
    {
        unset($this->subKegiatanInputs[$index]);
        $this->subKegiatanInputs = array_values($this->subKegiatanInputs); // Reset array keys
    }

    // Tambah input dasar hukum baru
    public function addDasarHukumInput()
    {
        $this->dasarHukumInputs[] = ['daskum_id' => ''];
    }

    // Hapus input dasar hukum
    public function removeDasarHukumInput($index)
    {
        unset($this->dasarHukumInputs[$index]);
        $this->dasarHukumInputs = array_values($this->dasarHukumInputs); // Reset array keys
    }

    // Simpan data
    public function save()
    {
        // Validasi data
        $this->validate([
            'subKegiatanInputs.*.sub_kegiatan_id' => 'required|exists:sub_kegiatan,sub_kegiatan_id',
            'dasarHukumInputs.*.daskum_id' => 'required|exists:dasar_hukum,daskum_id',
            // Tambahkan validasi untuk field lainnya
        ]);

        // Simpan data ke database
        // Contoh: Simpan ke tabel paket_pekerjaan, paket_sub_kegiatan, dan paket_dasar_hukum
        // ...

        // Redirect atau tampilkan pesan sukses
        session()->flash('message', 'Data berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.paket-pekerjaan-form');
    }
}