<?php

namespace App\Http\Controllers;

use App\Exports\KontrakExport;
use App\Models\Kontrak;
use App\Models\Ppkom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tim;
use App\Models\JadwalKegiatan;
use App\Models\RincianBelanja;
use App\Models\Peralatan;
use App\Models\RuangLingkup;
use App\Models\Template;
use Number;
use NumberFormatter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
Carbon::setLocale('id');




class KontrakController extends Controller
{
    //
    public function index()
    {
        return view("pages.admin.riwayat-kontrak.riwayat-kontrak", ['title' => 'riwayat kontrak']);
    }

    public function show(Kontrak $kontrak)
    {
        $kontrak = Kontrak::where('kontrak_id', $kontrak->kontrak_id)
            ->with(['verifikator', 'penyedia', 'satuanKerja', 'paketPekerjaan'])
            ->first();

        $templates = Template::all();

        if(Auth::user()->role == 'admin') {
            return view('pages.admin.riwayat-kontrak.detail-kontrak', [
                'kontrak' => $kontrak,
                'templates' => $templates
            ]);
        }

        return view('pages.verifikator.riwayat.detail-kontrak', [
            'kontrak' => $kontrak,
            'templates' => $templates
        ]);
    }

    public function updateTemplate(Kontrak $kontrak, Request $request)
    {
        $request->validate([
            'template_id' => 'nullable|exists:templates,template_id',
        ]);

        $kontrak->update([
            'template_id' => $request->template_id,
        ]);

        return redirect()->route('admin.riwayat-kontrak.show', $kontrak->kontrak_id)
            ->with('success', 'Template berhasil disimpan.');
    }

    public function exportKontrak()
    {
        return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }


    public function store(Request $request)
    {
        try {
            $tahun = now()->year;
            $penyediaId = auth()->user()->penyedia->penyedia_id;
            // 'APBD', 'DAK', 'BANKEU', 'APBD Perubahan', 'APBD Perubahan Biasa', 'BANKEU Perubahan', 'SG', 'Bantuan Pemerintah'
            switch ($request->sumber_dana) {
                case 'APBD':
                    $sumber_dana = 'A';
                    break;
                case 'DAK' :
                    $sumber_dana = 'D';
                    break;
                case 'BANKEU' :
                    $sumber_dana = 'B';
                    break;
                case 'APBD Perubahaan' || 'APBD Perubahaan Biasa' || 'BANKEU Perubahaan':
                    $sumber_dana = 'P';
                    break;
                case 'Bantuan Pemerintah' :
                    $sumber_dana = 'BP';
                    break;
                case 'SG' :
                    $sumber_dana = 'S';
                    break;
                default:
                    $sumber_dana = '';
                    break;
            }
            switch($request->metode_pemilihan) {
                case 'Jasa Konsultasi Perencanaan' :
                    $metode = '1';
                    break;
                case 'Jasa Konsultasi Pengawasan' :
                    $metode = '2';
                    break;
                case 'Pekerjaan Konstruksi' :
                    $metode = '3';
                    break;
                case 'Pengadaan Barang' :
                    $metode = '4';
                    break;
                default:
                    $metode = '';
                    break;
            }
            // 'Jasa Konsultasi Pengawasan', 'Jasa Konsultasi Perencanaan', 'Pekerjaan Konstruksi', 'Pengadaan Barang'

            $nomorKontrak = "400.3.18/{$request->paket_id}/{$sumber_dana}{$metode}/{$tahun}";

            $kontrak = Kontrak::create([
                'no_kontrak' => $nomorKontrak,
                'paket_id' => $request->paket_id,
                'jenis_kontrak' => $request->metode_pemilihan,
                'nomor_spk' => $nomorKontrak,
                'penyedia_id' => $penyediaId,
                'satker_id' => 1,
                'is_verificated' => false
            ]);

            return redirect()->route('penyedia.permohonan-kontrak.edit', ['kontrak' => $kontrak->kontrak_id])->with('success', 'Kontrak berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Kontrak $kontrak, )
    {
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

                'berkas_penawaran' => 'nullable|file|mimes:pdf|max:10240',
            ]);

            if ($request->hasFile('berkas_penawaran')) {
                $pdf = $request->file('berkas_penawaran');
                $FileName = time() . '_' . $pdf->getClientOriginalName();
                $pdfFilePath = $pdf->storeAs('uploads/berkasPenawaran', $FileName, 'public');
                $pdfFilePath = 'storage/' . $pdfFilePath;
                $validatedData['berkas_penawaran'] = $pdfFilePath;
            }
            $validatedData['tgl_pembuatan'] = now()->toDateString();

            $kontrak->update($validatedData);

            return redirect()->back()->with('success', 'Data dasar berhasil diupdate.')->withFragment('lampiran');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data dasar: ' . $e->getMessage());
        }
    }

    public function detail(Kontrak $kontrak){
        $rincianBelanja = RincianBelanja::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get();
        $totalBiaya = $rincianBelanja->sum('total_harga');
        $ppn = $totalBiaya * 0.11;

        return view('pages.penyedia.permohonan-kontrak.detail-kontrak', [
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
                ->with([
                    'verifikator',
                    'penyedia',
                    'satuanKerja',
                    'paketPekerjaan',
                    'subKegiatan',
                    'template',
                    'detailKontrak',
                    'tim',
                    'peralatan',
                    'rincianBelanja',
                    'penerima',
                ])
                ->first();

            // Pilih template
            // $templateName = $request->template ?? 'default_template.docx';
            // $templatePath = storage_path('app/templates/kontrak/' . $templateName);

            $templateName = $kontrak->template()->withTrashed()->first()->file_path ?? 'default_template.docx';
            $templatePath = storage_path('app/' . $templateName);

            // Pastikan template ada
            if (!file_exists($templatePath)) {
                return redirect()->back()->with('error', 'Template tidak ditemukan!');
            }

            // Setup PhpWord
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

            // Paket pekerjaan
            $templateProcessor->setValue('${KODE_PAKET}', $kontrak->paketPekerjaan->kode_paket);
            $templateProcessor->setValue('${PEKERJAAN_JUDUL}', $kontrak->paketPekerjaan->nama_pekerjaan . " " . $kontrak->paketPekerjaan->sekolah->nama_sekolah ?? '');
            $templateProcessor->setValue('${SUMBER_DANA}', $kontrak->paketPekerjaan->sumber_dana);
            $templateProcessor->setValue('${JENIS_PENGADAAN}', $kontrak->paketPekerjaan->jenis_pengadaan);
            $templateProcessor->setValue('${METODE_PEMILIHAN}', $kontrak->paketPekerjaan->metode_pemilihan);
            $templateProcessor->setValue('${NILAI_PAGU_PAKET}', number_format($kontrak->paketPekerjaan->nilai_pagu_paket, 0, ',', '.'));
            $templateProcessor->setValue('${PAGU_ANGGARAN}', number_format($kontrak->paketPekerjaan->nilai_pagu_anggaran, 0, ',', '.'));
            $templateProcessor->setValue('${NILAI_HPS}', number_format($kontrak->paketPekerjaan->nilai_hps, 0, ',', '.'));
            $templateProcessor->setValue('${TAHUN_ANGGARAN}', $kontrak->paketPekerjaan->tahun_anggaran);

            // Sub Kegiatan
            // $templateProcessor->setValue('${SUB_KEGIATAN}', $kontrak->paketPekerjaan->subKegiatan->first()->nama_sub_kegiatan ?? '');
            $subKegiatanList = $kontrak->paketPekerjaan->subKegiatan
                ->pluck('nama_sub_kegiatan')
                ->implode("\n");

            $templateProcessor->setValue('${SUB_KEGIATAN}', $subKegiatanList);
            $subKegiatanCollection = $kontrak->paketPekerjaan->subKegiatan;

            foreach ($subKegiatanCollection as $index => $subKegiatan) {
                $varName = '${REKENING_SUB_KEGIATAN' . ($index + 1) . '}';

                $templateProcessor->setValue($varName, $subKegiatan->no_rekening ?? '');
            }

            $templateProcessor->setValue('${REKENING_SUB_KEGIATAN}', $kontrak->paketPekerjaan->subKegiatan->first()->no_rekening ?? '');

            // Kontrak

            $noKontrak = $kontrak->no_kontrak;
            $noSpmk = preg_replace('/\/(\d+)\//', '/$1.a/', $noKontrak);

            $templateProcessor->setValue('${NO_KONTRAK}', $noKontrak);
            $templateProcessor->setValue('${NO_SPMK}', $noSpmk);

            $templateProcessor->setValue('${JENIS_KONTRAK}', $kontrak->jenis_kontrak);
            $templateProcessor->setValue('${TGL_PEMBUATAN}', Carbon::parse($kontrak->tanggal_awal)->translatedFormat(('d F Y')));

            $terbilangTanggal = Carbon::parse($kontrak->tanggal_awal);

            $bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            $spellout = new NumberFormatter("id", NumberFormatter::SPELLOUT);

            $hari  = ucwords($spellout->format($terbilangTanggal->day));
            $tahun = ucwords($spellout->format($terbilangTanggal->year));
            $namaBulan = $bulan[$terbilangTanggal->month - 1];

            $templateProcessor->setValue(
                '${TERBILANG_TGL_PEMBUATAN}',
                "{$hari} {$namaBulan} Tahun {$tahun}"
            );


            $templateProcessor->setValue('${WAKTU_KONTRAK}', $kontrak->waktu_kontrak);
            $templateProcessor->setValue('${NILAI_KONTRAK}', number_format($kontrak->nilai_kontrak, 0, ',', '.'));
            $templateProcessor->setValue('${TERBILANG_NILAI_KONTRAK}', $kontrak->terbilang_nilai_kontrak);
            $templateProcessor->setValue('${TGL_KONTRAK}', Carbon::parse($kontrak->tgl_kontrak)->translatedFormat('d F Y'));
            $templateProcessor->setValue('${NOMOR_DPPL}', $kontrak->nomor_dppl);
            $templateProcessor->setValue('${TGL_DPPL}', Carbon::parse($kontrak->tgl_dppl)->translatedFormat(('d F Y')));
            $templateProcessor->setValue('${NOMOR_BAHPL}', $kontrak->nomor_bahpl);
            $templateProcessor->setValue('${TGL_BAHPL}', Carbon::parse($kontrak->tgl_bahpl)->translatedFormat('d F Y'));
            $templateProcessor->setValue('${NOMOR_SPPBJ}', $kontrak->nomor_sppbj);
            $templateProcessor->setValue('${TGL_SPPBJ}', Carbon::parse($kontrak->tgl_sppbj)->translatedFormat('d F Y'));
            $templateProcessor->setValue('${NOMOR_PENETAPAN_PEMENANG}', $kontrak->nomor_penetapan_pemenang);
            $templateProcessor->setValue('${TGL_PENETAPAN_PEMENANG}', $kontrak->tgl_penetapan_pemenang);
            $templateProcessor->setValue('${TGL_SELESAI}', Carbon::parse($kontrak->tanggal_akhir)->translatedFormat('d F Y'));
            $templateProcessor->setValue('${JANGKA_WAKTU}', $kontrak->waktu_kontrak);


            $digit = new NumberFormatter("id", NumberFormatter::SPELLOUT);
            $terbilang = ucwords($digit->format($kontrak->waktu_kontrak));

            $templateProcessor->setValue('${TERBILANG_JANGKA_WAKTU}', $terbilang);

            $templateProcessor->setValue('${NO_SPK}', $kontrak->nomor_spk);

            // Penyedia
            $templateProcessor->setValue('${NAMA_DIREKTUR}', $kontrak->penyedia->nama_pemilik);
            $templateProcessor->setValue('${ALAMAT_PEMILIK}', $kontrak->penyedia->alamat_pemilik);
            $templateProcessor->setValue('${NAMA_CV}', $kontrak->penyedia->nama_perusahaan_lengkap);
            $templateProcessor->setValue('${ALAMAT_PERUSAHAAN}', $kontrak->penyedia->alamat_perusahaan);
            $templateProcessor->setValue('${KONTAK_HP}', $kontrak->penyedia->kontak_hp);
            $templateProcessor->setValue('${EMAIL_CV}', $kontrak->penyedia->kontak_email);
            $templateProcessor->setValue('${NAMA_BANK_CV}', $kontrak->penyedia->rekening_bank);
            $templateProcessor->setValue('${REKENING_NO}', $kontrak->penyedia->rekening_norek);
            $templateProcessor->setValue('${REKENING_NAMA}', $kontrak->penyedia->rekening_nama);
            $templateProcessor->setValue('${NAMA_CV_REKENING}', $kontrak->penyedia->rekening_nama);
            $templateProcessor->setValue('${NO_AKTA}', $kontrak->penyedia->akta_notaris_no);
            $templateProcessor->setValue('${TGL_AKTA}', Carbon::parse($kontrak->penyedia->akta_notaris_tanggal)->translatedFormat('d F Y'));
            $templateProcessor->setValue('${NAMA_NOTARIS}', $kontrak->penyedia->akta_notaris_nama);

            // PPK
            $templateProcessor->setValue('$NAMA_PPK', Ppkom::first()->nama);
            $templateProcessor->setValue('$JABATAN_PPK', Ppkom::first()->jabatan);

            // ruang lingkup
            $lingkupPekerjaanText = '';

            if ($kontrak->detailKontrak && $kontrak->detailKontrak->count() > 0) {
                foreach ($kontrak->detailKontrak as $index => $lingkup) {
                    $lingkupPekerjaanText .= ($index + 1) . ". " . $lingkup->detail . "\n";
                }

                $lingkupPekerjaanText = rtrim($lingkupPekerjaanText);
            } else {
                $lingkupPekerjaanText = '-';
            }

            $templateProcessor->setValue('${LINGKUP_PEKERJAAN}', $lingkupPekerjaanText);

            if ($kontrak->detailKontrak && $kontrak->detailKontrak->count() > 0) {
                foreach ($kontrak->detailKontrak as $index => $lingkup) {
                    $varName = '${LINGKUP_PEKERJAAN' . ($index + 1) . '}';

                    $templateProcessor->setValue($varName, $lingkup->detail ?? '-');
                }

                for ($i = $kontrak->detailKontrak->count() + 1; $i <= 10; $i++) {
                    $varName = '${LINGKUP_PEKERJAAN' . $i . '}';
                    $templateProcessor->setValue($varName, '');
                }
            } else {
                // set ke strip jika tidak ada lingkup pekerjaan
                for ($i = 1; $i <= 10; $i++) {
                    $varName = '${LINGKUP_PEKERJAAN' . $i . '}';
                    $templateProcessor->setValue($varName, '');
                }
                $templateProcessor->setValue('${LINGKUP_PEKERJAAN1}', '-');
            }


            // Verifikator
            if ($kontrak->verifikator) {
                $templateProcessor->setValue('${NIP_VERIFIKATOR}', $kontrak->verifikator->nip ?? '-');
                $templateProcessor->setValue('${NAMA_VERIFIKATOR}', $kontrak->verifikator->nama_verifikator ?? '-');
                $templateProcessor->setValue('${TGL_VERIFIKASI}', Carbon::parse($kontrak->tgl_verifikasi)->translatedFormat('d F Y') ?? '-');
            } else {
                $templateProcessor->setValue('${NIP_VERIFIKATOR}', '-');
                $templateProcessor->setValue('${NAMA_VERIFIKATOR}', '-');
                $templateProcessor->setValue('${TGL_VERIFIKASI}', '-');
            }

            // tabel-tabel

            $templateVariables = $templateProcessor->getVariables();
            // detail_kontrak
            $detail_kontrak = [];

            if ($kontrak->detailKontrak && $kontrak->detailKontrak->count() > 0) {
                foreach ($kontrak->detailKontrak as $index => $detail) {
                    $detail_kontrak[] = [
                        'TABLE_DETAIL' => $detail->detail,
                        'TABLE_NILAI' => number_format($detail->nilai, 0, ',', '.'),
                    ];
                }
            }

            if (in_array('TABLE_DETAIL', $templateVariables)) {
                $templateProcessor->cloneRowAndSetValues('TABLE_DETAIL', $detail_kontrak);
            }

            // tim
            $tim_table = [];

            if ($kontrak->tim && $kontrak->tim->count() > 0) {
                foreach ($kontrak->tim as $index => $tim) {
                    $tim_table[] = [
                        'NO_TIM' => $index + 1,
                        'TABLE_NAMA' => $tim->nama,
                        'TABLE_POSISI' => $tim->posisi,
                        'TABLE_STATUS_TENAGA' => $tim->status_tenaga,
                        'TABLE_PENDIDIKAN' => $tim->pendidikan,
                        'TABLE_PENGALAMAN' => $tim->pengalaman,
                        'TABLE_SERTIFIKASI' => $tim->sertifikasi,
                        'TABLE_KETERANGAN' => $tim->keterangan
                    ];
                }
            }

            if (in_array('NO_TIM', $templateVariables)) {
                $templateProcessor->cloneRowAndSetValues('NO_TIM', $tim_table);
            }
            // peralatan
            $peralatan_table = [];

            if ($kontrak->peralatan && $kontrak->peralatan->count() > 0) {
                foreach ($kontrak->peralatan AS $index => $peralatan){
                    $peralatan_table[] = [
                        'NO_PERALATAN' => $index + 1,
                        'TABLE_NAMA_PERALATAN' => $peralatan->nama_peralatan,
                        'TABLE_MERK' => $peralatan->merk,
                        'TABLE_TYPE' => $peralatan->type,
                        'TABLE_KAPASITAS' => $peralatan->kapasitas,
                        'TABLE_JUMLAH' => $peralatan->jumlah,
                        'TABLE_KONDISI' => $peralatan->kondisi,
                        'TABLE_STATUS_KEPEMILIKAN' => $peralatan->status_kepemilikan,
                        'TABLE_KETERANGAN' => $peralatan->keterangan
                    ];
                }
            }

            if (in_array('NO_PERALATAN', $templateVariables)) {
                $templateProcessor->cloneRowAndSetValues('NO_PERALATAN', $peralatan_table);
            }

            // rincian_belanja / rincian barang

            $rincian_belanja_table = [];

            if ($kontrak->rincianBelanja && $kontrak->rincianBelanja->count() > 0) {
                foreach ($kontrak->rincianBelanja AS $index => $rincian){
                    $rincian_belanja_table[] = [
                        'NO_RINCIAN_BELANJA' => $index + 1,
                        'TABLE_JENIS' => $rincian->jenis,
                        'TABLE_QTY' => $rincian->qty,
                        'TABLE_SATUAN' => $rincian->satuan,
                        'TABLE_HARGA_SATUAN' => $rincian->harga_satuan,
                        'TABLE_ONGKOS_KIRIM' => $rincian->ongkos_kirim,
                        'TABLE_TOTAL_HARGA' => $rincian->total_harga,
                    ];
                }
            }

            if (in_array('NO_RINCIAN_BELANJA', $templateVariables)) {
                $templateProcessor->cloneRowAndSetValues('NO_RINCIAN_BELANJA', $rincian_belanja_table);
            }

            // penerima

            $penerima_table = [];

            if ($kontrak->penerima && $kontrak->penerima->count() > 0) {
                foreach ($kontrak->penerima AS $index => $penerima){
                    $penerima_table[] = [
                        'NO_PENERIMA' => $index + 1,
                        'TABLE_NAMA_SEKOLAH' => $penerima->keterangan_penerima,
                        'TABLE_ALAMAT' => $penerima->alamat,
                        'TABLE_QTY' => $penerima->qty,
                        'TABLE_SATUAN' => $penerima->satuan,
                    ];
                }
            }

            if (in_array('NO_PENERIMA', $templateVariables)) {
                $templateProcessor->cloneRowAndSetValues('NO_PENERIMA', $penerima_table);
            }




            $outputDocx = storage_path('app/temp/' . time() . '_kontrak.docx');
            $outputPdf = storage_path('app/temp/' . time() . '_kontrak.pdf');
            $templateProcessor->saveAs($outputDocx);

            $format = $request->format ?? 'pdf';
            if ($format == 'docx') {
                return response()->download($outputDocx,  $kontrak->paketPekerjaan->paket_id . ". " . $kontrak->paketPekerjaan->nama_paket_pekerjaan . " (" . $kontrak->penyedia->nama_perusahaan_lengkap . ').docx')->deleteFileAfterSend(true);
            } else {
                $outputPdf = storage_path('app/temp/' . time() . '_kontrak.pdf');
                $process = new Process([
                    'unoconv',
                    '-f',
                    'pdf',
                    '-o',
                    $outputPdf,
                    $outputDocx
                ]);
                $process->run();
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                return response()->file($outputPdf, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $kontrak->paketPekerjaan->paket_id . ". " . $kontrak->paketPekerjaan->nama_paket_pekerjaan . " (" .  $kontrak->penyedia->nama_perusahaan_lengkap . ').pdf"'
                ])->deleteFileAfterSend(true);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengexport PDF: ' . $e->getMessage());
        }
    }
}
