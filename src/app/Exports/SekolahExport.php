<?php
namespace App\Exports;
use App\Models\Sekolah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SekolahExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sekolah::query()->get()->map(function ($sekolah) {
            $koordinat = $sekolah->koordinat ?? "";
            $longitude = "";
            $latitude = "";
            
            if (!empty($koordinat) && strpos($koordinat, 'POINT') !== false) {
                $koordinat = str_replace('POINT(', '', $koordinat);
                $koordinat = str_replace(')', '', $koordinat);
                
                $koordinat_array = explode(' ', $koordinat);
                if (count($koordinat_array) >= 2) {
                    $longitude = trim($koordinat_array[0]);
                    $latitude = trim($koordinat_array[1]);
                    
                    if (is_numeric($longitude) && is_numeric($latitude)) {
                    } else {
                        $longitude = "";
                        $latitude = "";
                    }
                }
            }
            
            return [
                "npsn" => $sekolah->npsn ?? "",
                "nama_sekolah" => $sekolah->nama_sekolah ?? "",
                "jenjang" => $sekolah->jenjang ?? "",
                "status" => $sekolah->status ?? "",
                "kepala_sekolah" => $sekolah->kepala_sekolah ?? "",
                "nip_kepala_sekolah" => $sekolah->nip_kepala_sekolah ?? "",
                "alamat" => $sekolah->alamat ?? "",
                "desa" => $sekolah->desa ?? "",
                "longitude" => $longitude,
                "latitude" => $latitude
            ];
        });
    }
    
    public function headings(): array
    {
        return [
            "NPSN", "NAMA SEKOLAH", "JENJANG", "STATUS", "KEPALA SEKOLAH", 
            "NIP KEPALA SEKOLAH", "ALAMAT", "DESA", "LONGITUDE", "LATITUDE"
        ];
    }
}