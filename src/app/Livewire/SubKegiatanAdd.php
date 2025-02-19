<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\SubKegiatanController;
use Illuminate\Http\Request;

class SubKegiatanAdd extends Component
{
    public $no_rekening;
    public $nama_sub_kegiatan;
    public $gabungan;
    public $pendidikan;

    public function save()
    {
        $this->validation();
        try {
            $request = new Request([
                'no_rekening' => $this->no_rekening,
                'nama_sub_kegiatan' => $this->nama_sub_kegiatan,
                'gabungan' => $this->gabungan,
                'pendidikan' => $this->pendidikan
            ]);

            // Panggil controller untuk menyimpan data
            $response = app(SubKegiatanController::class)->store($request);


            // Reset form setelah submit
            $this->reset(
                'no_rekening',
                'nama_sub_kegiatan',
                'gabungan',
                'pendidikan'
            );

            $this->dispatch('Saved');
            $this->dispatch('success', 'Sub Kegiatan berhasil disimpan.');
        }catch (\Exception $e) {
            $this->dispatch('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function validation(){
        $this->validate([
            'no_rekening' => 'required|numeric',
            'nama_sub_kegiatan' => 'required|string|max:255',
            'gabungan' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
        ], [
            'no_rekening.required' => 'Nomor rekening harus diisi.',
            'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
            'nama_sub_kegiatan.required' => 'Nama sub kegiatan harus diisi.',
            'nama_sub_kegiatan.string' => 'Nama sub kegiatan harus berupa teks.',
            'nama_sub_kegiatan.max' => 'Nama sub kegiatan maksimal 255 karakter.',
            'gabungan.required' => 'Gabungan harus diisi.',
            'gabungan.string' => 'Gabungan harus berupa teks.',
            'gabungan.max' => 'Gabungan maksimal 255 karakter.',
            'pendidikan.required' => 'Pendidikan harus diisi.',
            'pendidikan.string' => 'Pendidikan harus berupa teks.',
            'pendidikan.max' => 'Pendidikan maksimal 255 karakter.',
        ]);
    }

    public function render()
    {
        return view('livewire.sub-kegiatan-add');
    }
}
