<?php

namespace App\Exports;

use App\Models\SubKegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubKegiatanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SubKegiatan::query()->get()->map(function ($subKegiatan) {
            return [
                'sub_kegiatan_id' => $subKegiatan->sub_kegiatan_id,
                'Nama Sub Kegiatan' => $subKegiatan->nama_sub_kegiatan,
                'Kode Rekening' => $subKegiatan->no_rekening,
                'Pendidikan' => $subKegiatan->pendidikan,
                'Gabungan' => $subKegiatan->no_rekening . " " . $subKegiatan->nama_sub_kegiatan
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Sub Kegiatan',
            'Nama Sub Kegiatan',
            'Kode Rekening',
            'Pendidikan',
            'Gabungan'
        ];
    }
}
