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
            return redirect()->back()->with('success', 'data berhasil diperbarui.');
        } else {
            KeteranganKontrak::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'keterangan' => $validateData['keterangan'],
                'jenis' => $validateData['jenis'],
            ]);
            return redirect()->back()->with('success', 'Keterangan Kontrak berhasil disimpan.');
        }
    }

    public function destroy($keterangan_id)
    {
        KeteranganKontrak::where('keterangan_id', $keterangan_id)->delete();
        return redirect()->back()->with('success', 'Keterangan Kontrak berhasil dihapus.');
    }
}
