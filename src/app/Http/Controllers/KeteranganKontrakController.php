<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeteranganKontrak;

class KeteranganKontrakController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kontrak_id' => 'required|exists:kontrak,kontrak_id',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:hak dan kewajiban,tindakan,fasilitas',
        ]);

        if ($request->keterangan_id) {
            KeteranganKontrak::where('keterangan_id', $request->keterangan_id)->update([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan' => $validateData['keterangan'],
                'jenis' => $validateData['jenis'],
            ]);
            $request->jenis = ($request->jenis == 'hak dan kewajiban') ? 'hakDanKewajiban' : $request->jenis;
            return redirect()->back()->with('success', 'data berhasil diperbarui.')->withFragment($request->jenis);
        } else {
            KeteranganKontrak::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan' => $validateData['keterangan'],
                'jenis' => $validateData['jenis'],
            ]);
            $request->jenis = ($request->jenis == 'hak dan kewajiban') ? 'hakDanKewajiban' : $request->jenis;
            return redirect()->back()->with('success', 'Keterangan Kontrak berhasil disimpan.')->withFragment($request->jenis);
        }
    }

    public function destroy($keterangan_id)
    {
        $jenis = KeteranganKontrak::where('keterangan_id', $keterangan_id)->select('jenis')->first();
        KeteranganKontrak::where('keterangan_id', $keterangan_id)->delete();
        $jenis->jenis = ($jenis->jenis == 'hak dan kewajiban') ? 'hakDanKewajiban' : $jenis->jenis;
        return redirect()->back()->with('success', 'Keterangan Kontrak berhasil dihapus.')->withFragment($jenis->jenis);
    }
}
