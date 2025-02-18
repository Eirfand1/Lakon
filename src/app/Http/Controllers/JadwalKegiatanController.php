<?php

namespace App\Http\Controllers;

use App\Model\JadwalKegiatan;
use Illuminate\Http\Request;

class JadwalKegiatanController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'kegiatan' => 'required|string|max:255',
                'bulan_1' => 'boolean',
                'bulan_2' => 'boolean',
                'bulan_3' => 'boolean',
                'bulan_4' => 'boolean',
                'bulan_5' => 'boolean',
                'bulan_6' => 'boolean',
                'bulan_7' => 'boolean',
                'bulan_8' => 'boolean',
                'bulan_9' => 'boolean',
                'bulan_10' => 'boolean',
                'bulan_11' => 'boolean',
                'bulan_12' => 'boolean',
                'keterangan' => 'string'
            ]);

            $dasarHukum = JadwalKegiatan::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'kegiatan' => $validateData['kegiatan'],
                'bulan_1' => $validateData['bulan_1'],
                'bulan_2' => $validateData['bulan_2'],
                'bulan_3' => $validateData['bulan_3'],
                'bulan_4' => $validateData['bulan_4'],
                'bulan_5' => $validateData['bulan_5'],
                'bulan_6' => $validateData['bulan_6'],
                'bulan_7' => $validateData['bulan_7'],
                'bulan_8' => $validateData['bulan_8'],
                'bulan_9' => $validateData['bulan_9'],
                'bulan_10' => $validateData['bulan_10'],
                'bulan_11' => $validateData['bulan_11'],
                'bulan_12' => $validateData['bulan_12'],
                'keterangan' => $validateData['keterangan'],
            ]);
            return redirect()->back()->with('success', 'Jadwal Kegiatan berhasil disimpan.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
