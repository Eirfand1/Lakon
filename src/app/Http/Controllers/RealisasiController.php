<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisasi;
use App\Models\Kontrak;

class RealisasiController extends Controller
{
    public function index() {
        return view('pages.admin.realisasi.realisasi');
    }

    /**
     * Detail (admin): ambil kontrak dan relasi realisasi terurut.
     */
    public function detail($kontrak_id) {
        $kontrak = Kontrak::where('kontrak_id', $kontrak_id)
            ->with([
                'paketPekerjaan',
                'penyedia',
                // urut berdasarkan sekolah -> tahun -> bulan
                'realisasi' => function ($query) {
                    $query->orderBy('sekolah', 'asc')
                        ->orderBy('tahun', 'asc')
                        ->orderBy('bulan', 'asc');
                }])
            ->firstOrFail();

        return view('pages.admin.realisasi.detail', ['kontrak' => $kontrak]);
    }

    /**
     * Detail untuk penyedia/konsultan (mirip dengan detail admin).
     */
    public function realisasi($kontrak_id)
    {
        $kontrak = Kontrak::where('kontrak_id', $kontrak_id)
            ->with([
                'paketPekerjaan',
                'realisasi' => function ($query) {
                    $query->orderBy('sekolah', 'asc')
                        ->orderBy('tahun', 'asc')
                        ->orderBy('bulan', 'asc');
                }])
            ->firstOrFail();

        return view('pages.penyedia.konsultan.realisasi.realisasi', ['kontrak' => $kontrak]);
    }

    /**
     * Simpan / update realisasi (sama logika seperti Anda sebelumnya).
     */
    public function storeRealisasi(Request $request, $kontrak_id)
    {
        $rules = [
            'sekolah' => 'required|string',
            'tahun' => 'required|numeric',
            'bulan' => 'required|numeric',
            'target' => 'required|string|max:255',
            'realisasi' => 'required|string|max:255',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar5' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar6' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        if ($request->realisasi_id) {
            $request->validate($rules);

            $oldRecord = Realisasi::where('realisasi_id', $request->realisasi_id)
                ->select('gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'gambar6')
                ->first();

            $oldName = $oldRecord ? $oldRecord->toArray() : null;

            $gambar[0] = $request->hasFile('gambar1') ? $request->file('gambar1') : null;
            $gambar[1] = $request->hasFile('gambar2') ? $request->file('gambar2') : null;
            $gambar[2] = $request->hasFile('gambar3') ? $request->file('gambar3') : null;
            $gambar[3] = $request->hasFile('gambar4') ? $request->file('gambar4') : null;
            $gambar[4] = $request->hasFile('gambar5') ? $request->file('gambar5') : null;
            $gambar[5] = $request->hasFile('gambar6') ? $request->file('gambar6') : null;

            $filePath = $this->createFilePath($gambar, $oldName);

            Realisasi::where('realisasi_id', $request->realisasi_id)->update([
                'sekolah' => $request->sekolah,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'gambar1' => $filePath[0],
                'gambar2' => $filePath[1],
                'gambar3' => $filePath[2],
                'gambar4' => $filePath[3],
                'gambar5' => $filePath[4],
                'gambar6' => $filePath[5],
            ]);

            return redirect()->back()->with('success', 'Realisasi berhasil diperbarui.');
        } else {
            $request->validate($rules);

            $gambar[0] = $request->file('gambar1');
            $gambar[1] = $request->file('gambar2');
            $gambar[2] = $request->file('gambar3');
            $gambar[3] = $request->file('gambar4');
            $gambar[4] = $request->file('gambar5');
            $gambar[5] = $request->file('gambar6');

            $filePath = $this->createFilePath($gambar);

            Realisasi::create([
                'kontrak_id' => $kontrak_id,
                'sekolah' => $request->sekolah,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'target' => $request->target,
                'realisasi' => $request->realisasi,
                'gambar1' => $filePath[0],
                'gambar2' => $filePath[1],
                'gambar3' => $filePath[2],
                'gambar4' => $filePath[3],
                'gambar5' => $filePath[4],
                'gambar6' => $filePath[5],
            ]);

            return redirect()->back()->with('success', 'Realisasi berhasil ditambahkan.');
        }
    }

    /**
     * Hapus realisasi
     */
    public function destroyRealisasi($realisasi_id) {
        Realisasi::where('realisasi_id', $realisasi_id)->delete();

        return redirect()->back()->with('success', 'Realisasi berhasil dihapus.')->withFragment('tableRealisasi');
    }

    /**
     * Simpan file gambar (maks 3). Jika update dan file kosong, gunakan old name.
     */
    private function createFilePath($gambar, $oldName = null) {
        $filePath = [null, null, null];
        for ($i = 0; $i < 6; $i++) {
            $value = isset($gambar[$i]) ? $gambar[$i] : null;
            if ($value) {
                $fileName = time() . '_' . $value->getClientOriginalName();
                $stored = $value->storeAs('uploads/realisasi', $fileName, 'public');
                $filePath[$i] = 'storage/' . $stored;
            } else {
                if (is_array($oldName) && array_key_exists('gambar'.($i+1), $oldName)) {
                    $filePath[$i] = $oldName['gambar'.($i+1)];
                } else {
                    $filePath[$i] = null;
                }
            }
        }
        return $filePath;
    }
}
