<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'nama_peralatan' => 'required|string|max:255',
                'merk' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'kapasitas' => 'required|string|max:255',
                'jumlah' => 'required|numeric',
                'kondisi' => 'required|in:Baik,Sedang,Rusak',
                'status_kepemilikan' => 'required|string|max:255',
                'keterangan' => 'nullable|string',

            ]);

            $dasarHukum = Peralatan::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'nama_peralatan' => $validateData['nama_peralatan'],
                'merk' => $validateData['merk'],
                'type' => $validateData['type'],
                'kapasitas' => $validateData['kapasitas'],
                'jumlah' => $validateData['jumlah'],
                'kondisi' => $validateData['kondisi'],
                'status_kepemilikan' => $validateData['status_kepemilikan'],
                'keterangan' => $validateData['keterangan'],
            ]);

            return redirect()->back()->with('success', 'Data Peralatan berhasil disimpan.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
