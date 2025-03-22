<?php

namespace App\Exports;

use App\Models\DasarHukum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DasarHukumExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return DasarHukum::query()->get()->map(function ($daskum) {
            return [
                'id' => $daskum->daskum_id,
                'dasar_hukum' => $daskum->dasar_hukum
            ];
        });
    }

    public function headings(): array{
        return [
            "ID", "Dasar Hukum"
        ];
    }
}
