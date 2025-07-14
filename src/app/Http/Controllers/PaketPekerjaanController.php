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

        $nomor_matriks = PaketPekerjaan::select('paket_id')->orderBy('paket_id', 'DESC')->first();
        $tracker = NoKontrakTracker::select('id_kontrak_last_year')->first();
        $next_nomor_matrik = $nomor_matriks->paket_id - $tracker->id_kontrak_last_year + 1;

        $tracker = NoKontrakTracker::first();
        $tahun_saat_ini = $tracker->this_year;
        if ($tahun_saat_ini != date('Y')) {
            $tracker->update([
                'id_kontrak_last_year' => $nomor_matriks->paket_id,
                'this_year' => date('Y'),
            ]);
            $next_nomor_matrik = 1;
        }
        // buat jadi 3 digit dengan 0 di depan
        $next_nomor_matrik = str_pad($next_nomor_matrik, 3, '0', STR_PAD_LEFT);
        return view('pages.admin.paket-pekerjaan.paket-pekerjaan', [
            "title" => "paket-pekerjaan",
            "next_nomor_matrik" => $next_nomor_matrik,
            // "paket" => $pakets,
            "sekolah" => Sekolah::select('nama_sekolah', 'sekolah_id')->get(),
            "dasarHukum" => DasarHukum::select('dasar_hukum', 'daskum_id')->get(),
            "subKegiatan" => SubKegiatan::select('nama_sub_kegiatan', 'sub_kegiatan_id', 'pendidikan')->get(),
            "satuanKerja" => SatuanKerja::findOrFail(1),
            "ppkom" => Ppkom::select('nama', 'ppkom_id')->get(),
        ]);
    }

    private function kode_sumber_dana($sumber_dana)
    {
        switch ($sumber_dana) {
            case 'APBD':
                return 'A';
                break;
            case 'DAK':
                return 'D';
                break;
            case 'BANKEU':
                return 'B';
                break;
            case 'APBD Perubahaan' || 'APBD Perubahaan Biasa' || 'BANKEU Perubahaan':
                return 'P';
                break;
            case 'Bantuan Pemerintah':
                return 'BP';
                break;
            case 'SG':
                return 'S';
                break;
            default:
                return '';
                break;
        }
    }

    private function kode_jenis_pengadaan($jenis_pengadaan)
    {
        switch ($jenis_pengadaan) {
            case 'Jasa Konsultasi Perencanaan':
                return '1';
                break;
            case 'Jasa Konsultasi Pengawasan':
                return '2';
                break;
            case 'Pekerjaan Konstruksi':
                return '3';
                break;
            case 'Pengadaan Barang':
                return '4';
                break;
            default:
                return '';
                break;
        }
    }

    public function store(Request $request)
    {
        // Validasi data

        session()->flash('modal', 'add-modal'); // beri tanda modal yang harus dibuka

        $validatedData = $request->validate([
            'nomor_matrik' => 'required|string|max:3|min:3',
            'nama_pekerjaan' => 'required|string|max:255',
            'waktu_paket' => 'required|date',
            'sub_kegiatan_id' => 'required|array',
            'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
            'sumber_dana' => 'required|string|max:255',
            'kode_sirup' => 'required|numeric|unique:paket_pekerjaan,kode_sirup',
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

        // Buat paket pekerjaan
        $paketPekerjaan = PaketPekerjaan::create([
            'nomor_matrik' => $validatedData['nomor_matrik'],
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
            'sekolah_id' => $validatedData['sekolah_id'] ?? null,
            'nomor_kontrak' => "ERROR",
        ]);

        $sumber_dana = $this->kode_sumber_dana($validatedData['sumber_dana']);
        $jenis = $this->kode_jenis_pengadaan($validatedData['jenis_pengadaan']);

        $paketPekerjaan->nomor_kontrak = "400.3.13/{$validatedData['nomor_matrik']}/{$sumber_dana}{$jenis}/" . date('Y');

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
            'nomor_matrik' => 'required|string|max:3|min:3',
            'nama_pekerjaan' => 'required|string|max:255',
            'waktu_paket' => 'required|date',
            'sub_kegiatan_id' => 'required|array',
            'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
            'sumber_dana' => 'required|string|max:255',
            'kode_sirup' => 'required|numeric|unique:paket_pekerjaan,kode_sirup,' . $paketPekerjaan->paket_id . ',paket_id',
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

        $sumber_dana = $this->kode_sumber_dana($validatedData['sumber_dana']);
        $jenis = $this->kode_jenis_pengadaan($validatedData['jenis_pengadaan']);
        $year = optional($paketPekerjaan->created_at)->format('Y') ?? now()->format('Y');
        $paketPekerjaan->nomor_kontrak = "400.3.13/{$validatedData['nomor_matrik']}/{$sumber_dana}{$jenis}/{$year}";

        $paketPekerjaan->update([
            'nomor_matrik' => $validatedData['nomor_matrik'],
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
            'nomor_kontrak' => $paket->nomor_kontrak,
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

    public function penomoran(Request $request)
    {
        $request->validate([
            'no_kontrak_next' => 'required|string|min:3|max:3',
        ]);

        $nextNomorMatrikRequest = $request->input('no_kontrak_next');

        $lastPaket = PaketPekerjaan::orderByDesc('paket_id')->first();
        if (!$lastPaket) {
            $lastPaket->paket_id = 0;
        }

        $lastPaketId = $lastPaket->paket_id;

        $newIdKontrakLastYear = $lastPaketId - $nextNomorMatrikRequest + 1;

        $tracker = NoKontrakTracker::first();
        $tracker->update([
            'id_kontrak_last_year' => $newIdKontrakLastYear,
        ]);

        return back()->with('success', 'Nomor matrik berhasil diperbarui ke: ' . $nextNomorMatrikRequest);
    }

}
