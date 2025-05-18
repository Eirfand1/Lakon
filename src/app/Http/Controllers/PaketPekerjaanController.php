<?php

namespace App\Http\Controllers;

use App\Exports\PaketPekerjaanExport;
use App\Models\DasarHukum;
use App\Models\PaketPekerjaan;
use App\Models\PaketSubKegiatan;
use App\Models\Ppkom;
use App\Models\SatuanKerja;
use App\Models\Sekolah;
use App\Models\SubKegiatan;
use App\Models\Kontrak;
use App\Models\NoKontrakTracker;
use Illuminate\Support\Facades\Auth;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaketPekerjaanController extends Controller
{
    public function index()
    {
        $pakets = PaketPekerjaan::with('subKegiatan')->get();
        return view('pages.admin.paket-pekerjaan.paket-pekerjaan', [
            "title" => "paket-pekerjaan",
            // "paket" => $pakets,
            "sekolah" => Sekolah::select('nama_sekolah', 'sekolah_id')->get(),
            "dasarHukum" => DasarHukum::select('dasar_hukum', 'daskum_id')->get(),
            "subKegiatan" => SubKegiatan::select('nama_sub_kegiatan', 'sub_kegiatan_id', 'pendidikan')->get(),
            "satuanKerja" => SatuanKerja::findOrFail(1),
            "ppkom" => Ppkom::select('nama', 'ppkom_id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'waktu_paket' => 'required|date',
            'sub_kegiatan_id' => 'required|array',
            'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
            'sumber_dana' => 'required|in:APBD,DAK,BANKEU,APBD Perubahan,APBD Perubahan Biasa,BANKEU Perubahan,SG,Bantuan Pemerintah',
            'kode_sirup' => 'required|numeric',
            'jenis_pengadaan' => 'required|in:Tender,Non Tender,E-Katalog,Swakelola',
            'metode_pemilihan' => 'required|in:Jasa Konsultasi Pengawasan,Jasa Konsultasi Perencanaan,Pekerjaan Konstruksi,Pengadaan Barang',
            'nilai_pagu_paket' => 'required|numeric',
            'nilai_pagu_anggaran' => 'required|numeric',
            'nilai_hps' => 'required|numeric',
            'daskum_id' => 'exists:dasar_hukum,daskum_id',
            'ppkom_id' => 'exists:ppkom,ppkom_id',
            'satker_id' => 'exists:satuan_kerja,satker_id',
            'tahun_anggaran' => 'required|numeric|min:1000|max:2999',
            'sekolah_id' => 'nullable|numeric'
        ]);

        // Buat paket pekerjaan
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
            'kode_sirup' => $validatedData['kode_sirup'],
            'sekolah_id' => $validatedData['sekolah_id'],
            'nomor_matrik' => "ERROR",
        ]);
        $tracker = NoKontrakTracker::first();
        $tahun_saat_ini = $tracker->this_year;
        if ($tahun_saat_ini != date('Y')) {
            $tracker->update([
                'id_kontrak_last_year' => $paketPekerjaan->paket_id - 1,
                'this_year' => date('Y'),
            ]);
        }
        $id_tahun_lalu = $tracker->id_kontrak_last_year;
        $nomor_matriks = $paketPekerjaan->paket_id - $id_tahun_lalu;

        $paketPekerjaan->nomor_matrik = str_pad($nomor_matriks, 3, '0', STR_PAD_LEFT);
        $paketPekerjaan->save();

        foreach ($validatedData['sub_kegiatan_id'] as $subKegiatanId) {
            PaketSubKegiatan::create([
                'paket_id' => $paketPekerjaan->paket_id,
                'sub_kegiatan_id' => $subKegiatanId,
            ]);
        }

        return redirect()->back()->with('success', 'Paket pekerjaan berhasil disimpan.');
    }

    public function update(Request $request, PaketPekerjaan $paketPekerjaan)
    {
            $validatedData = $request->validate([
                'nama_pekerjaan' => 'required|string|max:255',
                'waktu_paket' => 'required|date',
                'sub_kegiatan_id' => 'required|array',
                'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
                'sumber_dana' => 'required|string|max:255',
                'kode_sirup' => 'required|numeric',
                'jenis_pengadaan' => 'required|string|max:255',
                'metode_pemilihan' => 'required|string|max:255',
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
                'kode_sirup' => $validatedData['kode_sirup'],
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
    }

    public function destroy(PaketPekerjaan $paket_pekerjaan): RedirectResponse
    {
        $paket_pekerjaan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }


    public function getPaketByKode($kode)
    {
        $user = Auth::user()->load('penyedia');

        if (!$user->penyedia->is_verificated) {
            return response()->json(['error' => 'Akun anda belum diverifikasi, silakan hubungi admin'], 403);
        }
        $paket = PaketPekerjaan::where('kode_sirup', $kode)->first();

        if (!$paket) {
            return response()->json(['error' => 'Paket tidak ditemukan'], 404);
        }

        $kontrak = Kontrak::where('paket_id', $paket->paket_id)->first();

        if ($kontrak) {
            return response()->json(['error' => 'Paket sudah memiliki kontrak'], 400);
        }

        return response()->json([
            'paket_id' => $paket->paket_id,
            'nomor_matrik' => $paket->nomor_matrik,
            'nama_pekerjaan' => $paket->nama_pekerjaan,
            'metode_pemilihan' => $paket->metode_pemilihan,
            'jenis_pengadaan' => $paket->jenis_pengadaan,
            'sumber_dana' => $paket->sumber_dana,
        ]);
    }

    public function exportPaketPekerjaan()
    {
        return Excel::download(new PaketPekerjaanExport, 'paket-pekerjaan.xlsx');
    }

}
