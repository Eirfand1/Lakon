<?php

namespace App\Exports;

use App\Models\Kontrak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

App::setLocale('id');
Carbon::setLocale('id');

class KontrakExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator', 'paketPekerjaan', 'paketPekerjaan.subKegiatan', 'tim', 'peralatan'])
            ->get()
            ->map(function ($kontrak) {
                if ($kontrak->paketPekerjaan->subKegiatan->count() > 1) {
                    $subBidangList = $kontrak->paketPekerjaan->subKegiatan->map(function ($sub) {
                        return '- ' . $sub->pendidikan;
                    })->implode("\n");

                    $noSubKegiatanList = $kontrak->paketPekerjaan->subKegiatan->map(function ($sub) {
                        return '- ' . $sub->no_rekening;
                    })->implode("\n");

                    $subKegiatanList = $kontrak->paketPekerjaan->subKegiatan->map(function ($sub) {
                        return '- ' . $sub->nama_sub_kegiatan;
                    })->implode("\n");
                }else if ($kontrak->paketPekerjaan->subKegiatan->first()) {
                    $subBidangList = $kontrak->paketPekerjaan->subKegiatan->first()->pendidikan;
                    $noSubKegiatanList = $kontrak->paketPekerjaan->subKegiatan->first()->no_rekening;
                    $subKegiatanList = $kontrak->paketPekerjaan->subKegiatan->first()->nama_sub_kegiatan;
                }else {
                    $subBidangList = '';
                    $noSubKegiatanList = '';
                    $subKegiatanList = '';
                }

                if ($kontrak->tim->count() > 1 && $kontrak->tim->first()) {
                    $timList = $kontrak->tim->map(function ($tim) {
                        return '- ' . $tim->nama;
                    })->implode("\n");

                    $posisiList = $kontrak->tim->map(function ($tim) {
                        return '- ' . $tim->posisi;
                    })->implode("\n");

                    $sertifikasiList = $kontrak->tim->map(function ($tim) {
                        return '- ' . $tim->sertifikasi;
                    })->implode("\n");
                }else if ($kontrak->tim->first()) {
                    $timList = $kontrak->tim->first()->nama;
                    $posisiList = $kontrak->tim->first()->posisi;
                    $sertifikasiList = $kontrak->tim->first()->sertifikasi;
                }else {
                    $timList = '';
                    $posisiList = '';
                    $sertifikasiList = '';
                }

                if ($kontrak->peralatan->count() > 1 && $kontrak->peralatan->first()) {
                    $peralatanList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->nama_peralatan;
                    })->implode("\n");
                    $merkList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->merk;
                    })->implode("\n");
                    $kapasitasList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->kapasitas;
                    })->implode("\n");
                    $jumlahList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->jumlah;
                    })->implode("\n");
                    $kondisiList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->kondisi;
                    })->implode("\n");
                    $statusList = $kontrak->peralatan->map(function ($peralatan) {
                        return '- ' . $peralatan->status_kepemilikan;
                    })->implode("\n");
                }else if ($kontrak->peralatan->first()) {
                    $peralatanList = $kontrak->peralatan->first()->peralatan;
                    $merkList = $kontrak->peralatan->first()->merk;
                    $kapasitasList = $kontrak->peralatan->first()->kapasitas;
                    $jumlahList = $kontrak->peralatan->first()->jumlah;
                    $kondisiList = $kontrak->peralatan->first()->kondisi;
                    $statusList = $kontrak->peralatan->first()->status_kepemilikan;
                }else {
                    $peralatanList = '';
                    $merkList = '';
                    $kapasitasList = '';
                    $jumlahList = '';
                    $kondisiList = '';
                    $statusList = '';
                }
                return [
                    'NO MATRIKS' => $kontrak->paketPekerjaan->nomor_matrik,

                    'SUB BIDANG' => $subBidangList,
                    'NO SUB KEGIATAN' => $noSubKegiatanList,
                    'SUB KEGIATAN' => $subKegiatanList,

                    'RUP' => $kontrak->paketPekerjaan->kode_sirup,
                    'NAMA PAKET PEKERJAAN' => $kontrak->paketPekerjaan->nama_pekerjaan,
                    'PAGU ANGGARAN' => "\u{200B}" . number_format($kontrak->paketPekerjaan->nilai_pagu_anggaran, 0, ',', '.'),
                    'PAGU PAKET' => "\u{200B}" . number_format($kontrak->paketPekerjaan->nilai_pagu_paket, 0, ',', '.'),
                    'HPS' => "\u{200B}" . number_format($kontrak->paketPekerjaan->nilai_hps, 0, ',', '.'),
                    'NILAI KONTRAK' => "\u{200B}" . number_format($kontrak->nilai_kontrak, 0, ',', '.'),
                    'TERBILANG KONTRAK' => $kontrak->terbilang_nilai_kontrak,
                    'SUMBER DANA' => $kontrak->paketPekerjaan->sumber_dana,
                    'METODE PEMILIHAN' => $kontrak->paketPekerjaan->metode_pemilihan,
                    'JENIS PENGADAAN' => $kontrak->paketPekerjaan->jenis_pengadaan,

                    'PENYEDIA' => $kontrak->penyedia ? $kontrak->penyedia->nama_perusahaan_lengkap : null,
                    'NAMA PEMILIK' => $kontrak->penyedia ? $kontrak->penyedia->nama_pemilik : null,
                    'STATUS PEMILIK' => $kontrak->penyedia ? $kontrak->penyedia->jabatan : null,
                    'ALAMAT KANTOR' => $kontrak->penyedia ? $kontrak->penyedia->alamat_perusahaan: null,
                    'NO NOTARIS' => $kontrak->penyedia ? $kontrak->penyedia->akta_notaris_no : null,
                    'TGL NOTARIS' => $kontrak->penyedia ? Carbon::parse($kontrak->penyedia->akta_notaris_tanggal)->translatedFormat('d F Y') : null,
                    'NAMA NOTARIS' => $kontrak->penyedia ? $kontrak->penyedia->akta_notaris_nama : null,

                    'NO_SPK' => $kontrak->nomor_spk ? $kontrak->nomor_spk : null,
                    'TGL MULAI' => $kontrak->tanggal_awal ? Carbon::parse($kontrak->tanggal_awal)->translatedFormat('d F Y') : null,
                    'TGL SELESAI' => $kontrak->tanggal_akhir ? Carbon::parse($kontrak->tanggal_akhir)->translatedFormat('d F Y') : null,
                    'JANGKA WAKTU (HK)' => $kontrak->waktu_kontrak ? $kontrak->waktu_kontrak : null,
                    'NO DPPL' => $kontrak->nomor_dppl ? $kontrak->nomor_dppl : null,
                    'TGL DPPL' => $kontrak->tgl_dppl ? Carbon::parse($kontrak->tgl_dppl)->translatedFormat('d F Y') : null,
                    'NO BAHPL' => $kontrak->nomor_bahpl ? $kontrak->nomor_bahpl : null,
                    'TGL BAHPL' => $kontrak->tgl_bahpl ? Carbon::parse($kontrak->tgl_bahpl)->translatedFormat('d F Y') : null,
                    'NO_SPMK' => $kontrak->nomor_sp ? $kontrak->nomor_sp : null,

                    'NAMA' => $timList,
                    'POSISI' => $posisiList,
                    'SERTIFIKASI' => $sertifikasiList,

                    'ALAT' => $peralatanList,
                    'MERK' => $merkList,
                    'KAPASITAS' => $kapasitasList,
                    'JUMLAH' => $jumlahList,
                    'KONDISI' => $kondisiList,
                    'STATUS' => $statusList,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NO MATRIKS',

            'SUB BIDANG',
            'NO SUB KEGIATAN',
            'SUB KEGIATAN',

            'RUP',
            'NAMA PAKET PEKERJAAN',
            'PAGU ANGGARAN',
            'PAGU PAKET',
            'HPS',
            'NILAI KONTRAK',
            'TERBILANG KONTRAK',
            'SUMBER DANA',
            'METODE PEMILIHAN',
            'JENIS PENGADAAN',
            'PENYEDIA',
            'NAMA PEMILIK',
            'STATUS PEMILIK',
            'ALAMAT KANTOR',
            'NO NOTARIS',
            'TGL NOTARIS',
            'NAMA NOTARIS',
            'NO_SPK',
            'TGL MULAI',
            'TGL SELESAI',
            'JANGKA WAKTU (HK)',
            'NO DPPL',
            'TGL DPPL',
            'NO BAHPL',
            'TGL BAHPL',
            'NO_SPMK',
            'NAMA',
            'POSISI',
            'SERTIFIKASI',
            'ALAT',
            'MERK',
            'KAPASITAS',
            'JUMLAH',
            'KONDISI',
            'STATUS',
        ];
    }
}
