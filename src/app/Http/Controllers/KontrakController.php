<?php

namespace App\Http\Controllers;

use App\Exports\KontrakExport;
use App\Models\Kontrak;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tim;
use App\Models\JadwalKegiatan;
use App\Models\RincianBelanja;
use App\Models\Peralatan;
use App\Models\RuangLingkup;
use PhpOffice\PhpSpreadsheet\IOFactory;
use SplFileObject;
use Swagger\Client\Api\ConvertDocumentApi;
use TCPDF;


class KontrakController extends Controller
{
    //
    public function index()
    {
        return view("pages.admin.riwayat-kontrak.riwayat-kontrak", ['title' => 'riwayat kontrak']);
    }

    public function show(Kontrak $kontrak)
    {
        $kontrak = Kontrak::where('kontrak_id', $kontrak->kontrak_id)->with(['verifikator', 'penyedia', 'satuanKerja', 'paketPekerjaan'])->first();

        $templates = Storage::files('templates/kontrak');
        $templates = array_map(function ($path) {
            return basename($path);
        }, $templates);

        return view('pages.admin.riwayat-kontrak.detail-kontrak', [
            'kontrak' => $kontrak,
            'templates' => $templates
        ]);
    }

    public function export()
    {
        return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }


    public function store(Request $request)
    {
        try {
            $tahun = now()->year;
            $penyediaId = auth()->user()->penyedia->penyedia_id;
            $nomorKontrak = "KONTRAK/{$penyediaId}/P4/{$tahun}";

            $kontrak = Kontrak::create([
                'no_kontrak' => $nomorKontrak,
                'paket_id' => $request->paket_id,
                'penyedia_id' => $penyediaId,
                'satker_id' => 1,
                'is_verificated' => false
            ]);

            return redirect()->route('penyedia.permohonan-kontrak.edit', ['kontrak' => $kontrak->kontrak_id])->with('success', 'Kontrak berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(
        Kontrak $kontrak,
        RuangLingkup $ruangLingkup
    ) {
        $rincianBelanja = RincianBelanja::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get();
        $totalBiaya = $rincianBelanja->sum('total_harga');
        $ppn = $totalBiaya * 0.11;

        return view('pages.penyedia.permohonan-kontrak.edit-kontrak', [
            'kontrak' => $kontrak,
            'tim' => Tim::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'jadwalKegiatan' => JadwalKegiatan::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'rincianBelanja' => $rincianBelanja,
            'totalBiaya' => $totalBiaya,
            'ppn' => $ppn,
            'peralatan' => Peralatan::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'ruangLingkup' => RuangLingkup::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
        ]);
    }

    public function update(Request $request, Kontrak $kontrak)
    {
        try {
            if ($kontrak->penyedia_id !== auth()->user()->penyedia->penyedia_id) {
                abort(403, 'Unauthorized action.');
            }

            $validatedData = $request->validate([
                // tender
                'nomor_sppbj' => 'nullable|string|max:255',
                'tgl_sppbj' => 'nullable|date',
                'nomor_penetapan_pemenang' => 'nullable|string|max:255',
                'tgl_penetapan_pemenang' => 'nullable|date',

                // non tender
                'nomor_dppl' => 'nullable|string|max:255',
                'tgl_dppl' => 'nullable|date',
                'nomor_bahpl' => 'nullable|string|max:255',
                'tgl_bahpl' => 'nullable|date',
            ]);

            $validatedData['tgl_pembuatan'] = now()->toDateString();

            $kontrak->update($validatedData);

            return redirect()->back()->with('success', 'Data dasar berhasil diupdate.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data dasar: ' . $e->getMessage());
        }
    }

    public function layangkan(Request $request, Kontrak $kontrak)
    {
        try {
            if ($kontrak->penyedia_id !== auth()->user()->penyedia->penyedia_id) {
                abort(403, 'Unauthorized action.');
            }

            $data['is_layangkan'] = true;

            $kontrak->update($data);

            return redirect()->route('penyedia.dashboard', ['kontrak' => $kontrak->id])
                ->with('success', 'Permohonan Kontrak berhasil');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal melakukan Permohonan kontrak: ' . $e->getMessage());
        }
    }

    public function exportPdf(Kontrak $kontrak, Request $request)
    {
        try {
            // Load kontrak dengan relasinya
            $kontrak = Kontrak::where('kontrak_id', $kontrak->kontrak_id)
                ->with(['verifikator', 'penyedia', 'satuanKerja', 'paketPekerjaan', 'subKegiatan'])
                ->first();

            // Pilih template
            $templateName = $request->template ?? 'default_template.docx';
            $templatePath = storage_path('app/templates/kontrak/' . $templateName);

            // Pastikan template ada
            if (!file_exists($templatePath)) {
                return redirect()->back()->with('error', 'Template tidak ditemukan!');
            }

            // Setup PhpWord
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

            // Isi variabel dari data kontrak
            $templateProcessor->setValue('${KODE_PAKET}', $kontrak->paketPekerjaan->kode_paket);
            $templateProcessor->setValue('${PEKERJAAN_JUDUL}', $kontrak->paketPekerjaan->nama_pekerjaan);
            $templateProcessor->setValue('${SUMBER_DANA}', $kontrak->paketPekerjaan->sumber_dana);
            $templateProcessor->setValue('${SUB_KEGIATAN}', $kontrak->subKegiatan->nama_sub_kegiatan);
            $templateProcessor->setValue('${NO_KONTRAK}', $kontrak->no_kontrak);
            $templateProcessor->setValue('${TGL_PEMBUATAN}', $kontrak->tgl_pembuatan);
            $templateProcessor->setValue('${JENIS_PENGADAAN}', $kontrak->paketPekerjaan->jenis_pengadaan);
            $templateProcessor->setValue('${METODE_PEMILIHAN}', $kontrak->paketPekerjaan->metode_pemilihan);
            $templateProcessor->setValue('${TAHUN_ANGGARAN}', $kontrak->paketPekerjaan->tahun_anggaran);
            $templateProcessor->setValue('${NILAI_PAGU_PAKET}', number_format($kontrak->paketPekerjaan->nilai_pagu_paket, 0, ',', '.'));
            $templateProcessor->setValue('${PAGU_ANGGARAN}', number_format($kontrak->paketPekerjaan->nilai_pagu_anggaran, 0, ',', '.'));
            $templateProcessor->setValue('${NILAI_HPS}', number_format($kontrak->paketPekerjaan->nilai_hps, 0, ',', '.'));
            $templateProcessor->setValue('${JENIS_KONTRAK}', $kontrak->jenis_kontrak);
            $templateProcessor->setValue('${NILAI_KONTRAK}', number_format($kontrak->nilai_kontrak, 0, ',', '.'));
            $templateProcessor->setValue('${TGL_KONTRAK}', $kontrak->tgl_kontrak);
            $templateProcessor->setValue('${WAKTU_KONTRAK}', $kontrak->waktu_kontrak);

            // Penyedia
            $templateProcessor->setValue('${NAMA_CV}', $kontrak->penyedia->nama_perusahaan_lengkap);
            $templateProcessor->setValue('${NAMA_DIREKTUR}', $kontrak->penyedia->nama_pemilik);
            $templateProcessor->setValue('${ALAMAT_PERUSAHAAN}', $kontrak->penyedia->alamat_perusahaan);
            $templateProcessor->setValue('${KONTAK_HP}', $kontrak->penyedia->kontak_hp);
            $templateProcessor->setValue('${EMAIL_CV}', $kontrak->penyedia->kontak_email);
            $templateProcessor->setValue('${NAMA_BANK_CV}', $kontrak->penyedia->rekening_bank);
            $templateProcessor->setValue('${REKENING_NO}', $kontrak->penyedia->rekening_norek);
            $templateProcessor->setValue('${NAMA_CV_REKENING}', $kontrak->penyedia->rekening_nama);
            $templateProcessor->setValue('${NO_AKTA}', $kontrak->penyedia->akta_notaris_no);
            $templateProcessor->setValue('${TGL_AKTA}', $kontrak->penyedia->akta_notaris_tanggal);
            $templateProcessor->setValue('${NAMA_NOTARIS}', $kontrak->penyedia->akta_notaris_nama);
            $templateProcessor->setValue('${NOMOR_DPPL}', $kontrak->nomor_dppl);
            $templateProcessor->setValue('${TGL_DPPL}', $kontrak->tgl_dppl);
            $templateProcessor->setValue('${NOMOR_BAHPL}', $kontrak->nomor_bahpl);
            $templateProcessor->setValue('${TGL_BAHPL}', $kontrak->tgl_bahpl);

            // Verifikator
            if ($kontrak->verifikator) {
                $templateProcessor->setValue('${NIP_VERIFIKATOR}', $kontrak->verifikator->nip ?? '-');
                $templateProcessor->setValue('${NAMA_VERIFIKATOR}', $kontrak->verifikator->nama_verifikator ?? '-');
                $templateProcessor->setValue('${TGL_VERIFIKASI}', $kontrak->tgl_verifikasi ?? '-');
            } else {
                $templateProcessor->setValue('${NIP_VERIFIKATOR}', '-');
                $templateProcessor->setValue('${NAMA_VERIFIKATOR}', '-');
                $templateProcessor->setValue('${TGL_VERIFIKASI}', '-');
            }


            $outputDocx = storage_path('app/temp/' . time() . '_kontrak.docx');
            $templateProcessor->saveAs($outputDocx);
    
            // Download PDF
            return response()->download($outputDocx, 'Kontrak_' . $kontrak->no_kontrak . '.docx')->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengexport PDF: ' . $e->getMessage());
        }
    }
}
