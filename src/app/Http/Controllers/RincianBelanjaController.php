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
                'keterangan' => 'nullable|string',
            ]);

            if ($request->rincian_belanja_id) {
                RincianBelanja::where('rincian_belanja_id', $request->rincian_belanja_id)->update([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'jenis' => $validateData['jenis'],
                    'uraian' => $validateData['uraian'],
                    'qty' => $validateData['qty'],
                    'satuan' => $validateData['satuan'],
                    'harga_satuan' => $validateData['harga_satuan'],
                    'keterangan' => $validateData['keterangan'],
                ]);
                return redirect()->back()->with('success', 'data berhasil diperbarui.');
            }else {
                RincianBelanja::create([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'jenis' => $validateData['jenis'],
                    'uraian' => $validateData['uraian'],
                    'qty' => $validateData['qty'],
                    'satuan' => $validateData['satuan'],
                    'harga_satuan' => $validateData['harga_satuan'],
                    'keterangan' => $validateData['keterangan'],
                ]);
                return redirect()->back()->with('success', 'Rincian Belanja berhasil disimpan.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($rincian_belanja){
        try{
            RincianBelanja::where('rincian_belanja_id', $rincian_belanja)->delete();
            return redirect()->back()->with('success', 'Rincian Belanja berhasil dihapus.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
