<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RincianBelanja;

class RincianBelanjaController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'jenis' => 'required|string|max:255',
                'uraian' => 'required|string|max:255',
                'qty' => 'required|numeric',
                'satuan' => 'required|string|max:255',
                'harga_satuan' => 'required|numeric',
                'keterangan' => '|string',
            ]);

            $dasarHukum = RincianBelanja::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'jenis' => $validateData['jenis'],
                'uraian' => $validateData['uraian'],
                'qty' => $validateData['qty'],
                'satuan' => $validateData['satuan'],
                'harga_satuan' => $validateData['harga_satuan'],
                'keterangan' => $validateData['keterangan'],
            ]);

            return redirect()->back()->with('success', 'Rincian Belanja berhasil disimpan.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
