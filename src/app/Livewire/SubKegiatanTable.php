<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubKegiatan;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class SubKegiatanTable extends DataTableComponent
{
    protected $model = SubKegiatan::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('sub_kegiatan_id')
             ->setPerPageAccepted([10,25,50,100, -1]);
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
            Column::make("Aksi", "sub_kegiatan_id")
                ->format(fn($value, $row) => view('pages.admin.sub-kegiatan.actions', ['sub_kegiatan' => $row])),

            Column::make("Kode Rekening ", "no_rekening")
                ->sortable()
                ->searchable(),
            Column::make("Nama Sub Kegiatan", "nama_sub_kegiatan")
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
                    // Hitung total
                    $totalPaguAnggaran = $paketList->sum('nilai_pagu_anggaran');
                    $totalPaguPaket = $paketList->sum('nilai_pagu_paket');
                    $totalHPS = $paketList->sum('nilai_hps');

                    $tableRows = $paketList->map(function ($paket) {
                        return "
                            <tr class='hover:bg-gray-50 dark:hover:bg-gray-700'>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->nomor_matrik}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->nama_pekerjaan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->kode_sirup}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->sumber_dana}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->tahun_anggaran}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->waktu_paket}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->metode_pemilihan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$paket->jenis_pengadaan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_pagu_anggaran, 0, '', '.') . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_pagu_paket, 0, '', '.') . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>Rp " . number_format($paket->nilai_hps, 0, '', '.') . "</td>
                            </tr>
                        ";
                    })->join('');

                    $footerRow = "
                            <tr class='bg-gray-100 dark:bg-gray-800 font-semibold'>
                                <td class='p-2 border-t dark:border-gray-700' colspan='8'>Total</td>
                                <td class='p-2 border-t dark:border-gray-700'>Rp " . number_format($totalPaguAnggaran, 0, '', '.') . "</td>
                                <td class='p-2 border-t dark:border-gray-700'>Rp " . number_format($totalPaguPaket, 0, '', '.') . "</td>
                                <td class='p-2 border-t dark:border-gray-700'>Rp " . number_format($totalHPS, 0, '', '.') . "</td>
                            </tr>
                        ";




                    return "
                        <div class='overflow-x-auto border rounded-lg w-max border-gray-700/20'>
                            <table class='divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class='bg-gray-50 dark:bg-gray-800'>
                                    <tr>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nomor Matrik</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nama Pekerjaan</th>
                                        <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Kode Sirup</th>
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
                                <tfoot>
                                    {$footerRow}
                                </tfoot>
                            </table>
                        </div>
                    ";
                })->html()->collapseAlways()
                ->searchable(function ($query, $searchTerm) {
                        $query->orWhereHas('paketPekerjaan', function ($subQuery) use ($searchTerm) {
                            $subQuery->where('nama_pekerjaan', 'like', "%{$searchTerm}%");
                        });
                  })
                ,



        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Hapus Terpilih',
        ];
    }

    public function deleteSelected()
    {
        SubKegiatan::whereIn('sub_kegiatan_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}
