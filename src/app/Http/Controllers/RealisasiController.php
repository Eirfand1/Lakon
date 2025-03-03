<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisasi;
use App\Models\Kontrak;

class RealisasiController extends Controller
{
    //
    public function index() {
        return view('pages.admin.realisasi.realisasi');
    }

    public function realisasi($kontrak_id)
    {
        $kontrak = Kontrak::where('kontrak_id', $kontrak_id)
            ->with([
                'paketPekerjaan',
                'realisasi' => function ($query) {
                    $query->orderBy('realisasi.tahun', 'asc')
                        ->orderBy('realisasi.bulan', 'asc');
                }])
            ->first();

        return view('pages.penyedia.konsultan.realisasi.realisasi', ['kontrak' => $kontrak]);
    }

    public function storeRealisasi(Request $request, $kontrak_id)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'bulan' => 'required|numeric',
            'target' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambar = $request->file('gambar');
        $fileName = time() . '_' . $gambar->getClientOriginalName();

        // Store file in the storage/app/public/uploads/realisasi directory
        $filePath = $gambar->storeAs('uploads/realisasi', $fileName, 'public');
        $filePath = 'storage/' . $filePath;

        Realisasi::create([
            'kontrak_id' => $kontrak_id,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'target' => $request->target,
            'gambar' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Realisasi berhasil ditambahkan.');
    }
}
