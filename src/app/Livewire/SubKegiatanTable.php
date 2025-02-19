<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubKegiatan;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Livewire\Attributes\On;

class SubKegiatanTable extends DataTableComponent
{
    protected $model = SubKegiatan::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('sub_kegiatan_id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return SubKegiatan::query()
            ->with(['paketPekerjaan'])
            ->orderBy('updated_at', 'desc');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),

            Column::make("Nama Sub Kegiatan", "nama_sub_kegiatan")
                ->sortable()
                ->searchable(),
            Column::make("No Rekening ", "no_rekening")
                ->sortable()
                ->searchable(),
            Column::make("Gabungan", "gabungan")
                ->sortable()
                ->searchable(),
            Column::make("Pendidikan", "pendidikan")
                ->sortable()
                ->searchable(),
            Column::make('Paket Pekerjaan', 'sub_kegiatan_id')
                ->format(function ($value, $row) {
                    $data = SubKegiatan::with('paketPekerjaan')->find($value);
                    $paketList = $data->paketPekerjaan;

                    if ($paketList->isEmpty()) {
                        return '<span class="text-gray-400">Tidak ada paket pekerjaan</span>';
                    }

                    $tableRows = $paketList->map(function ($paket, $index) {
                        return "
                            <tr class='hover:bg-gray-50 dark:hover:bg-gray-700'>
                                <td class='p-2 border-b dark:border-gray-700 text-center'>" . ($index + 1) . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->nama_pekerjaan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->kode_paket}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->sumber_dana}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->tahun_anggaran}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->waktu_paket}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->metode_pemilihan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->jenis_pengadaan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_pagu_anggaran, 2) . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_pagu_paket, 2) . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_hps, 2) . "</td>
                            </tr>
                        ";
                    })->join('');

                    return "
                        <div class='overflow-x-auto border rounded-lg w-max border-gray-700/20'>
                            <table class='divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class='bg-gray-50 dark:bg-gray-800'>
                                    <tr>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>No</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nama Pekerjaan</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Kode Paket</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Sumber Dana</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Tahun Anggaran</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Waktu Paket</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Metode Pemilihan</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Jenis Pengadaan</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nilai Pagu Anggaran</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nilai Pagu Paket</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nilai HPS</th>
                                    </tr>
                                </thead>
                                <tbody class='bg-white divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700'>
                                    {$tableRows}
                                </tbody>
                            </table>
                        </div>
                    ";
                })->html()->collapseAlways(),

            Column::make("Aksi", "sub_kegiatan_id")
                ->format(fn($value, $row) => view('pages.admin.sub-kegiatan.actions', ['sub_kegiatan' => $row])),
        ];
    }

    #[On('Saved')]
    public function refreshTable()
    {

    }
}
