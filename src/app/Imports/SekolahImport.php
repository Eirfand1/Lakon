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
        if (empty($row['koordinat']) || !str_contains($row['koordinat'], ',')) {
            return null;
        }

        $koordinat = array_map('trim', explode(',', $row['koordinat']));

        if (count($koordinat) !== 2 || !is_numeric($koordinat[0]) || !is_numeric($koordinat[1])) {
            return null;
        }

        $latitude = $koordinat[0];
        $longitude = $koordinat[1];

        return new Sekolah([
            'npsn' => $row['npsn'],
            'nama_sekolah' => $row['nama_sekolah'],
            'jenjang' => $row['jenjang'],
            'status' => $row['status'],
            'alamat' => $row['alamat'],
            'desa' => $row['desa'],
            'kecamatan' => $row['kecamatan'],
            'koordinat' => DB::raw("POINT($latitude, $longitude)"),
        ]);
    }
}
