<?php

namespace App\Http\Controllers;

use App\Models\DasarHukum;
use App\Models\PaketPekerjaan;
use App\Models\PaketSubKegiatan;
use App\Models\Ppkom;
use App\Models\SatuanKerja;
use App\Models\Sekolah;
use App\Models\SubKegiatan;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaketPekerjaanController extends Controller
{
    public function index()
    {
        $pakets = PaketPekerjaan::with('subKegiatan')->get();
        return view('pages.admin.paket-pekerjaan.paket-pekerjaan', [
            "title" => "paket-pekerjaan",
            "paket" => $pakets,
            "sekolah" => Sekolah::select('nama_sekolah', 'sekolah_id')->get(),
            "dasarHukum" => DasarHukum::select('dasar_hukum','daskum_id')->get(),
            "subKegiatan" => SubKegiatan::select('nama_sub_kegiatan', 'sub_kegiatan_id')->get(),
            "satuanKerja" => SatuanKerja::findOrFail(1),
            "ppkom" => Ppkom::select('nama', 'ppkom_id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_pekerjaan' => 'required|string|max:255',
                'waktu_paket' => 'required|date',
                'sub_kegiatan_id' => 'required|array',
                'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
                'sumber_dana' => 'required|in:APBN,APBD,Swasta',
                'kode_paket' => 'required|numeric',
                'jenis_pengadaan' => 'required|in:tender,non_tender,e_catalog',
                'metode_pemilihan' => 'required|string',
                'nilai_pagu_paket' => 'required|numeric',
                'nilai_pagu_anggaran' => 'required|numeric',
                'nilai_hps' => 'required|numeric',
                'daskum_id' => 'exists:dasar_hukum,daskum_id',
                'ppkom_id' => 'exists:ppkom,ppkom_id',
                'satker_id' => 'exists:satuan_kerja,satker_id',
                'tahun_anggaran' => 'required|numeric|min:1000|max:2999',
                'sekolah_id' => 'nullable|numeric'
            ]);

            $paketPekerjaan = PaketPekerjaan::create([
                'nama_pekerjaan' => $validatedData['nama_pekerjaan'],
                'waktu_paket' => $validatedData['waktu_paket'],
                'sumber_dana' => $validatedData['sumber_dana'],
                'tahun_anggaran' => $validatedData['tahun_anggaran'],
                'satker_id' => $validatedData['satker_id'],
                'metode_pemilihan' => $validatedData['metode_pemilihan'],
                'jenis_pengadaan' => $validatedData['jenis_pengadaan'],
                'nilai_pagu_paket' => $validatedData['nilai_pagu_paket'],
                'nilai_pagu_anggaran' => $validatedData['nilai_pagu_anggaran'],
                'nilai_hps' => $validatedData['nilai_hps'],
                'ppkom_id' => $validatedData['ppkom_id'],
                'daskum_id' => $validatedData['daskum_id'],
                'kode_paket' => $validatedData['kode_paket'],
                'sekolah_id' => $validatedData['sekolah_id']
            ]);


            // Simpan hubungan many-to-many ke tabel pivot (sub_kegiatan_paket)
            foreach ($validatedData['sub_kegiatan_id'] as $subKegiatanId) {
                PaketSubKegiatan::create([
                    'paket_id' => $paketPekerjaan->paket_id,
                    'sub_kegiatan_id' => $subKegiatanId,
                ]);
            }

            return redirect()->back()->with('success', 'Paket pekerjaan berhasil disimpan.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function update(Request $request, PaketPekerjaan $paketPekerjaan)
    {
        try {
            $validatedData = $request->validate([
                'nama_pekerjaan' => 'required|string|max:255',
                'waktu_paket' => 'required|date',
                'sub_kegiatan_id' => 'required|array',
                'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
                'sumber_dana' => 'required|in:APBN,APBD,Swasta',
                'kode_paket' => 'required|numeric',
                'jenis_pengadaan' => 'required|in:tender,non_tender,e_catalog',
                'metode_pemilihan' => 'required|string',
                'nilai_pagu_paket' => 'required|numeric',
                'nilai_pagu_anggaran' => 'required|numeric',
                'nilai_hps' => 'required|numeric',
                'daskum_id' => 'exists:dasar_hukum,daskum_id',
                'ppkom_id' => 'exists:ppkom,ppkom_id',
                'satker_id' => 'exists:satuan_kerja,satker_id',
                'tahun_anggaran' => 'required|numeric|min:1000|max:2999',
                'sekolah_id' => 'nullable|numeric'
            ]);

            $paketPekerjaan->update([
                'nama_pekerjaan' => $validatedData['nama_pekerjaan'],
                'waktu_paket' => $validatedData['waktu_paket'],
                'sumber_dana' => $validatedData['sumber_dana'],
                'tahun_anggaran' => $validatedData['tahun_anggaran'],
                'satker_id' => $validatedData['satker_id'],
                'metode_pemilihan' => $validatedData['metode_pemilihan'],
                'jenis_pengadaan' => $validatedData['jenis_pengadaan'],
                'nilai_pagu_paket' => $validatedData['nilai_pagu_paket'],
                'nilai_pagu_anggaran' => $validatedData['nilai_pagu_anggaran'],
                'nilai_hps' => $validatedData['nilai_hps'],
                'ppkom_id' => $validatedData['ppkom_id'],
                'daskum_id' => $validatedData['daskum_id'],
                'kode_paket' => $validatedData['kode_paket'],
                'sekolah_id' => $validatedData['sekolah_id']
            ]);

            // Hapus semua data yang memiliki paket_id yang sama
            PaketSubKegiatan::where('paket_id', $paketPekerjaan->paket_id)->delete();

            // simpan id di tabel pivot
            foreach ($validatedData['sub_kegiatan_id'] as $subKegiatanId) {
                PaketSubKegiatan::create([
                    'paket_id' => $paketPekerjaan->paket_id,
                    'sub_kegiatan_id' => $subKegiatanId,
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(PaketPekerjaan $paket_pekerjaan): RedirectResponse
    {
        try {
            $paket_pekerjaan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }


    public function getPaketByKode($kode)
    {
        $paket = PaketPekerjaan::where('kode_paket', $kode)->first();

        if (!$paket) {
            return response()->json(['error' => 'Paket tidak ditemukan'], 404);
        }

        return response()->json([
            'paket_id' => $paket->paket_id,
            'nama_pekerjaan' => $paket->nama_pekerjaan,
            'metode_pemilihan' => $paket->metode_pemilihan,
            'jenis_pengadaan' => $paket->jenis_pengadaan
        ]);
    }

}
