<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DasarHukum;
use App\Http\Controllers\DasarHukumController;
class DasarHukumFormAdd extends Component
{
    public $dasar_hukum;

    public function save()
    {
        $this->validation();
        try {
            $request = new Request([
                'dasar_hukum' => $this->dasar_hukum,
            ]);

            // Panggil controller untuk menyimpan data
            $response = app(DasarHukumController::class)->store($request);

            $this->dispatch('dasarHukumSaved');

            // Reset form setelah submit
            $this->reset('dasar_hukum');

            $this->dispatch('success', 'Dasar Hukum berhasil disimpan.');
        }catch (\Exception $e) {
            $this->dispatch('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function validation(){
        $this->validate([
            'dasar_hukum' => 'required|string|max:255',
        ], [
            'dasar_hukum.required' => 'Dasar Hukum harus diisi.',
            'dasar_hukum.string' => 'Dasar Hukum harus berupa teks.',
            'dasar_hukum.max' => 'Dasar Hukum tidak boleh lebih dari 255 karakter.',
        ]);
    }

    public function render()
    {
        return view('livewire.dasar-hukum-form-add');
    }
}
