<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerima;

class PenerimaController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kontrak_id' => 'required|exists:kontrak,kontrak_id',
            'keterangan_penerima' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'satuan' => 'required|string|max:255',
        ]);

        if ($request->penerima_id) {
            Penerima::where('penerima_id', $request->penerima_id)->update([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan_penerima' => $validateData['keterangan_penerima'],
                'alamat' => $validateData['alamat'],
                'qty' => $validateData['qty'],
                'satuan' => $validateData['satuan'],
            ]);
            return redirect()->back()->with('success', 'data berhasil diperbarui.');
        } else {
            Penerima::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan_penerima' => $validateData['keterangan_penerima'],
                'alamat' => $validateData['alamat'],
                'qty' => $validateData['qty'],
                'satuan' => $validateData['satuan'],
            ]);
            return redirect()->back()->with('success', 'Penerima berhasil disimpan.');
        }
    }

    public function destroy($penerima_id)
    {
        Penerima::where('penerima_id', $penerima_id)->delete();
        return redirect()->back()->with('success', 'Penerima berhasil dihapus.');
    }
}
