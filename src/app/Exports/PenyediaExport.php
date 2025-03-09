<?php

namespace App\Exports;

use App\Models\Penyedia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenyediaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penyedia::with('user')->get()->map(function ($penyedia) {
            return [
                'id' => $penyedia->penyedia_id,
                'username' => $penyedia->user->name ?? '',
                'status' => $penyedia->status,
                'nama_pemilik' => $penyedia->nama_pemilik,
                'alamat_pemilik' => $penyedia->alamat_pemilik,
                'nama_perusahaan_lengkap' => $penyedia->nama_perusahaan_lengkap,
                'nama_perusahaan_singkat' => $penyedia->nama_perusahaan_singkat,
                'akta_notaris_no' => $penyedia->akta_notaris_no,
                'akta_notaris_nama' => $penyedia->akta_notaris_nama,
                'akta_notaris_tanggal' => $penyedia->akta_notaris_tanggal,
                'alamat_perusahaan' => $penyedia->alamat_perusahaan,
                'kontak_hp' => $penyedia->kontak_hp,
                'kontak_email' => $penyedia->kontak_email,
                'rekening_norek' => $penyedia->rekening_norek,
                'rekening_nama' => $penyedia->rekening_nama,
                'rekening_bank' => $penyedia->rekening_bank,
                'npwp_perusahaan' => $penyedia->npwp_perusahaan,
            ];
        });
    }


    public function headings(): array
    {
        return [
            'No Penyedia',
            'Username',
            'Status',
            'Nama Pemilik',
            'Alamat Pemilik',
            'Nama Perusahaan Lengkap',
            'Nama Perusahaan Singkat',
            'Nomor Akta Notaris',
            'Nama Akta Notaris',
            'Tanggal Akta Notaris',
            'Alamat Perusahaan',
            'Kontak HP',
            'Kontak Email',
            'No rekening',
            'Nama Rekening',
            'Bank Rekening',
            'NPWP Perusahaan'
        ];
    }
}
