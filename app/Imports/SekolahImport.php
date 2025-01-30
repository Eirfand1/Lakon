<?php

namespace App\Imports;

use App\Models\Sekolah;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SekolahImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Sekolah([
            'npsn'           => $row['npsn'],
            'nama_sekolah'   => $row['nama_sekolah'],
            'jenjang'        => $row['jenjang'],
            'status'         => $row['status'],
            'alamat'         => $row['alamat'],
            'desa'           => $row['desa'],
            'kecamatan'      => $row['kecamatan'],
            'koordinat'      => DB::raw("ST_GeomFromText('POINT({$row['koordinat']})')"),
        ]);
    }
}
