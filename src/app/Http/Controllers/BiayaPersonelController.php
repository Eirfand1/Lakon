<?php

namespace App\Http\Controllers;

use App\Models\BiayaPersonel;
use Illuminate\Http\Request;

class BiayaPersonelController extends Controller
{
     public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'jenis_biaya' => 'required|string|max:255',
                'uraian_biaya' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'qty' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'keterangan' => 'required|string',
            ]);

            if ($request->biaya_personel_id) {
                BiayaPersonel::where('biaya_personel_id', $request->biaya_personel_id)->update([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'jenis_biaya' => $validateData['jenis_biaya'],
                    'uraian_biaya' => $validateData['uraian_biaya'],
                    'satuan' => $validateData['satuan'],
                    'qty' => $validateData['qty'],
                    'harga' => $validateData['harga'],
                    'keterangan' => $request->keterangan,
                ]);
                return redirect()->back()->with('success', 'Biaya non Personel berhasil diperbarui.')->withFragment('biayaNonPersonel');
            } else {
                BiayaPersonel::create([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'jenis_biaya' => $validateData['jenis_biaya'],
                    'uraian_biaya' => $validateData['uraian_biaya'],
                    'satuan' => $validateData['satuan'],
                    'qty' => $validateData['qty'],
                    'harga' => $validateData['harga'],
                    'keterangan' => $request->keterangan,
                ]);
                return redirect()->back()->with('success', 'Biaya non Personel berhasil disimpan.')->withFragment('biayaNonPersonel');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withFragment('biayaNonPersonel');
        }
    }

    public function destroy($biaya_personel)
    {
        try {
            BiayaPersonel::where('biaya_personel_id', $biaya_personel)->delete();
            return redirect()->back()->with('success', 'Biaya non Personel berhasil dihapus.')->withFragment('biayaNonPersonel');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withFragment('biayaNonPersonel');
        }
    }
}
