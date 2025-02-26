<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenKontrak;

class DokumenKontrakController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate([
            'kontrak_id' => 'required|exists:kontrak,kontrak_id',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:penagihan,pekerjaan,tambahan'
        ]);

        if($request->dokumen_id){
            DokumenKontrak::where('dokumen_id', $request->dokumen_id)->update([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan' => $validateData['keterangan'],
                'jenis' => $validateData['jenis'],
            ]);
            return redirect()->back()->with('success', 'data berhasil diperbarui.');
        }else{
            DokumenKontrak::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan' => $validateData['keterangan'],
                'jenis' => $validateData['jenis'],
            ]);
            return redirect()->back()->with('success', 'Dokumen Kontrak berhasil disimpan.');
        }
    }

    public function destroy($dokumen_id){
        DokumenKontrak::where('dokumen_id', $dokumen_id)->delete();
        return redirect()->back()->with('success', 'Dokumen Kontrak berhasil dihapus.');
    }
}
