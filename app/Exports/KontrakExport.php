<?php

namespace App\Exports;

use App\Models\Kontrak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KontrakExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator'])
            ->get()
            ->map(function ($kontrak) {
                return [
                    'id' => $kontrak->kontrak_id,
                    'nama_satuan_kerja' => $kontrak->satuanKerja ? $kontrak->satuanKerja->nama_pimpinan : null,
                    'nama_perusahaan_penyedia' => $kontrak->penyedia ? $kontrak->penyedia->nama_perusahaan_lengkap : null,
                    'nama_verifikator' => $kontrak->verifikator ? $kontrak->verifikator->nama_verifikator : null,
                    'jenis_kontrak' => $kontrak->jenis_kontrak,
                    'nilai_kontrak' => $kontrak->nilai_kontrak,
                    'tgl_kontrak' => $kontrak->tgl_kontrak,
                    'waktu_kontrak' => $kontrak->waktu_kontrak,
                    'tgl_pembuatan' => $kontrak->tgl_pembuatan,
                    'nama_sub_kegiatan' => $kontrak->subKegiatan->nama_sub_kegiatan,
                    'nomor_dppl' => $kontrak->nomor_dppl,
                    'tgl_dppl' => $kontrak->tgl_dppl,
                    'nomor_bahpl' => $kontrak->nomor_bahpl,
                    'tgl_bahpl' => $kontrak->tgl_bahpl,
                    'status_verifikasi' => $kontrak->is_verificated ? "ter verifikasi" : "belum verifikasi"
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID', 'Nama Satuan Kerja', 'Nama Perusahaan Penyedia', 'Nama Verifikator', 
            'Jenis Kontrak', 'Nilai Kontrak', 'Tanggal Kontrak', 'Waktu Kontrak', 
            'Tanggal Pembuatan', 'Nama Sub Kegiatan', 'Nomor DPPL', 'Tanggal DPPL', 
            'Nomor BAHPL', 'Tanggal BAHPL', 'Status Verifikasi',
        ];
    }
}
