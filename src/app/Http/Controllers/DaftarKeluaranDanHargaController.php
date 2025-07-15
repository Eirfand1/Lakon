<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarKeluaranDanHarga;

class DaftarKeluaranDanHargaController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'keluaran' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'total_harga' => 'required|numeric',
            ]);

            if ($request->daftar_keluaran_dan_harga_id) {
                DaftarKeluaranDanHarga::where('daftar_keluaran_dan_harga_id', $request->daftar_keluaran_dan_harga_id)->update([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'keluaran' => $validateData['keluaran'],
                    'satuan' => $validateData['satuan'],
                    'total_harga' => $validateData['total_harga'],
                ]);
                return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil diperbarui.')->withFragment('daftarKeluaranDanHarga');
            }else {
                DaftarKeluaranDanHarga::create([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'keluaran' => $validateData['keluaran'],
                    'satuan' => $validateData['satuan'],
                    'total_harga' => $validateData['total_harga'],
                ]);
                return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil disimpan.')->withFragment('daftarKeluaranDanHarga');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withFragment('daftarKeluaranDanHarga');
        }
    }

    public function destroy($id){
        try{
            DaftarKeluaranDanHarga::where('daftar_keluaran_dan_harga_id', $id)->delete();
            return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil dihapus.')->withFragment('daftarKeluaranDanHarga');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withFragment('daftarKeluaranDanHarga');
        }
    }
}
