<?php

namespace App\Livewire;

use App\Exports\KontrakExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Kontrak;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class RealisasiTable extends DataTableComponent
{
    protected $model = Kontrak::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('kontrak_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setPerPageAccepted([10, 25, 50, 100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator', 'realisasi'])
            ->orderByDesc('kontrak.updated_at')
            ->whereIsVerificated(true);
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Hapus Terpilih',
            'export' => 'Download excel'
        ];
    }

    public function export()
    {
        return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }

    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),
            Column::make("No Kontrak", "no_kontrak")
                ->sortable()
                ->searchable(),
            Column::make("Penyedia", "penyedia.nama_perusahaan_lengkap") // Relasi
                ->sortable()
                ->searchable(),
            Column::make("Jenis Kontrak", "jenis_kontrak")
                ->sortable()
                ->searchable(),
            Column::make("Tanggal Pembuatan", "tgl_pembuatan")
                ->sortable(),
            Column::make('Aksi', 'kontrak_id')
                ->format(function ($value) {
                    return '
                            <a  href="detail-realisasi/'.$value.'"
                            class="btn btn-sm btn-info dark:text-gray-50">
                            realisasi</a>
                            ';
                })->html(),
        ];
    }
}
