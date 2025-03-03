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
            Column::make('Realisasi', 'kontrak_id')
                ->format(
                    function ($value, $row) {

                        $data = Kontrak::with('realisasi')->find($value);
                        $realisasiList = $data->realisasi;

                        $tableRows = $realisasiList->map(function ($realisasi, $index) {
                            return "
                            <tr class='hover:bg-gray-50 dark:hover:bg-gray-700'>
                                <td class='p-2 border-b dark:border-gray-700 text-center'>" . ($index + 1) . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$realisasi->bulan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$realisasi->tahun}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$realisasi->target}</td>
                                <td class='p-2 dark:border-gray-700'><img src='" . asset('storage/' .$realisasi->gambar) . "' class='w-auto h-48 object-cover'></td>
                            </tr>

                        ";
                        })->join('');

                        return "
                        <div class='overflow-x-auto border rounded-lg w-max border-gray-700/20'>
                                <table class='divide-y divide-gray-200 dark:divide-gray-700'>
                                    <thead class='bg-gray-50 dark:bg-gray-800'>
                                        <tr>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>No</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Bulan</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Tahun</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Target</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody class='bg-white divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700'>
                                        {$tableRows}
                                    </tbody>
                                </table>
                        </div>
                    ";
                    }
                )->html()->collapseAlways()->searchable(),
        ];
    }
}
