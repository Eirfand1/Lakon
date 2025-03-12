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
        if ($request->realisasi_id) {
            $request->validate([
                'tahun' => 'required|numeric',
                'bulan' => 'required|numeric',
                'target' => 'required|string|max:255',
                'realisasi' => 'required|string|max:255',
                'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $oldName = Realisasi::where('realisasi_id', $request->realisasi_id)->select('gambar1', 'gambar2', 'gambar3')->first()->toArray();
            // dd($oldName['gambar1']);

            $gambar[0] = ($request->gambar1) ? $request->file('gambar1') : null;
            $gambar[1] = ($request->gambar2) ? $request->file('gambar2') : null;
            $gambar[2] = ($request->gambar3) ? $request->file('gambar3') : null;

            $filePath = $this->createFilePath($gambar, $oldName);

            Realisasi::where('realisasi_id', $request->realisasi_id)->update([
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'gambar1' => $filePath[0],
                'gambar2' => $filePath[1],
                'gambar3' => $filePath[2],
            ]);

            return redirect()->back()->with('success', 'Realisasi berhasil diperbarui.');
        }else {
            $request->validate([
                'tahun' => 'required|numeric',
                'bulan' => 'required|numeric',
                'target' => 'required|string|max:255',
                'realisasi' => 'required|string|max:255',
                'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gambar3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $gambar[0] = $request->file('gambar1');
            $gambar[1] = $request->file('gambar2');
            $gambar[2] = $request->file('gambar3');

            $filePath = $this->createFilePath($gambar);

            Realisasi::create([
                'kontrak_id' => $kontrak_id,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'gambar1' => $filePath[0],
                'gambar2' => $filePath[1],
                'gambar3' => $filePath[2],
            ]);

            return redirect()->back()->with('success', 'Realisasi berhasil ditambahkan.');
        }
    }

    private function createFilePath($gambar, $oldName = null) {
        $i = 0;
        foreach ($gambar as $value) {
            if ($value) {
                $fileName[$i] = time() . '_' . $value->getClientOriginalName();

                // Store file in the storage/app/public/uploads/realisasi directory
                $filePath[$i] = $value->storeAs('uploads/realisasi', $fileName[$i], 'public');
                $filePath[$i] = 'storage/' . $filePath[$i];
            }else {
                $filePath[$i] = $oldName['gambar'.$i+1];
            }
            $i++;
        }

        return $filePath;
    }

    public function destroyRealisasi($realisasi_id) {
        Realisasi::where('realisasi_id', $realisasi_id)->delete();

        return redirect()->back()->with('success', 'Realisasi berhasil dihapus.')->withFragment('tableRealisasi');
    }
}
