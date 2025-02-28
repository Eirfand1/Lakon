<?php
namespace App\Livewire;

use App\Models\DasarHukum;
use App\Models\PaketPekerjaan;
use App\Models\SubKegiatan;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class PaketPekerjaanTable extends DataTableComponent
{
    protected $model = PaketPekerjaan::class;
    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('paket_id')
            ->setDefaultSort('created_at', 'desc')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setPerPageAccepted([10, 25, 50, 100, -1]);

    }
    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        $query = PaketPekerjaan::query()
            ->with([
                'satuanKerja',
                'dasarHukum',
                'ppkom',
                'subKegiatan',
                'sekolah'
            ])->orderBy('paket_pekerjaan.updated_at', 'desc');

        return $query;
    }


    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),

            //  TO-DO : buat isi kolom = paket pekerjaan + nama sekolah
            Column::make('Nama Paket Pekerjaan', 'nama_pekerjaan')
                ->format(function ($value, $row) {
                    // $data = PaketPekerjaan::with('sekolah_id')->find($row['sekolah.sekolah_id']);
                    // dd($data);
                    return $value . /* $data */ '';
                })
                ->sortable()
                ->searchable(),

            Column::make('Sekolah', 'sekolah.nama_sekolah')
                ->hideIf(true),

            Column::make('Sekolah', 'sekolah.sekolah_id')
                ->hideIf(true),

            Column::make('Kode Paket', 'kode_paket')
                ->sortable()
                ->searchable(),

            Column::make('Sumber Dana', 'sumber_dana')
                ->sortable()
                ->searchable(),

            Column::make('Tahun Anggaran', 'tahun_anggaran')
                ->sortable()
                ->searchable(),

            Column::make('Satuan Kerja', 'satuanKerja.nama_pimpinan')
                ->sortable()
                ->searchable(),


            Column::make('Sub Kegiatan', 'paket_id')
                ->format(function ($value, $row) {
                    $data = PaketPekerjaan::with('subKegiatan')->find($value);
                    $subKegiatanList = $data->subKegiatan;

                    if ($subKegiatanList->isEmpty()) {
                        return '<span class="text-gray-400">Tidak ada sub kegiatan</span>';
                    }

                    $tableRows = $subKegiatanList->map(function ($subKegiatan, $index) {
                        return "
                            <tr class='hover:bg-gray-50 dark:hover:bg-gray-700'>
                                <td class='p-2 border-b dark:border-gray-700 text-center'>" . ($index + 1) . "</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$subKegiatan->nama_sub_kegiatan}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$subKegiatan->no_rekening}</td>
                                <td class='p-2 border-b dark:border-gray-700'>{$subKegiatan->gabungan}</td>
                                <td class='p-2 dark:border-gray-700'>{$subKegiatan->pendidikan}</td>
                            </tr>

                        ";
                    })->join('');

                    return "
                        <div class='overflow-x-auto border rounded-lg w-max border-gray-700/20'>
                                <table class='divide-y divide-gray-200 dark:divide-gray-700'>
                                    <thead class='bg-gray-50 dark:bg-gray-800'>
                                        <tr>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>No</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Nama Sub Kegiatan</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>No Rekening</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Gabungan</th>
                                            <th class='p-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300'>Pendidikan</th>
                                        </tr>
                                    </thead>
                                    <tbody class='bg-white divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700'>
                                        {$tableRows}
                                    </tbody>
                                </table>
                        </div>
                    ";
                })->html()->collapseAlways()->searchable(),



            Column::make('Waktu Paket', 'waktu_paket')
                ->sortable()
                ->searchable(),

            Column::make('Metode Pemilihan', 'metode_pemilihan')
                ->sortable()
                ->searchable(),

            Column::make('Jenis Pengadaan', 'jenis_pengadaan')
                ->sortable()
                ->searchable(),

            Column::make('Ppkom', 'ppkom.nama')
                ->sortable()
                ->searchable(),

            Column::make('Dasar Hukum', 'dasarHukum.dasar_hukum')
                ->sortable()
                ->searchable(),

            Column::make('Daskum Id', 'dasarHukum.daskum_id')
                ->hideIf(true),

            Column::make('Nilai Pagu Paket')
                ->searchable()
                ->sortable()
                ->format(fn($value, $row) => 'Rp ' . number_format($row->nilai_pagu_paket, 2)),

            Column::make('Nilai Pagu Anggaran')
                ->searchable()
                ->sortable()
                ->format(fn($value, $row) => 'Rp ' . number_format($row->nilai_pagu_anggaran, 2)),

            Column::make('Nilai HPS', 'nilai_hps')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => 'Rp ' . number_format($row->nilai_hps, 2)),
            Column::make("Aksi", "paket_id")
                ->format(fn($value, $row) => view('pages.admin.paket-pekerjaan.actions', ['paket' => $row])),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Hapus Terpilih',
        ];
    }

    public function filters(): array
    {
        return [
            // Existing filters
            SelectFilter::make('Jenis Pengadaan')
                ->options([
                    '' => 'Semua Jenis',
                ] + PaketPekerjaan::distinct()->pluck('jenis_pengadaan', 'jenis_pengadaan')->toArray())
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('jenis_pengadaan', $value) : $builder;
                }),

            // Sub Kegiatan Filter (Many to Many)
            SelectFilter::make('Sub Kegiatan')
                ->options([
                    '' => 'Semua Sub Kegiatan',
                ] + SubKegiatan::orderBy('nama_sub_kegiatan')
                        ->pluck('nama_sub_kegiatan', 'sub_kegiatan_id')
                        ->toArray())
                ->filter(function ($builder, $value) {
                    return $value
                        ? $builder->whereHas('subKegiatan', function ($query) use ($value) {
                            $query->where('sub_kegiatan.sub_kegiatan_id', $value);
                        })
                        : $builder;
                }),

            // Dasar Hukum Filter
            SelectFilter::make('Dasar Hukum')
                ->options([
                    '' => 'Semua Dasar Hukum',
                ] + DasarHukum::orderBy('dasar_hukum')
                        ->pluck('dasar_hukum', 'daskum_id')
                        ->toArray())
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('dasarHukum.daskum_id', $value) : $builder;
                }),

            SelectFilter::make('Tahun Anggaran')
                ->options([
                    '' => 'Semua Tahun',
                ] + PaketPekerjaan::distinct()->pluck('tahun_anggaran', 'tahun_anggaran')->toArray())
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('tahun_anggaran', $value) : $builder;
                }),

            SelectFilter::make('Sumber Dana')
                ->options([
                    '' => "Semua sumber dana"
                ] + PaketPekerjaan::distinct()->pluck('sumber_dana', 'sumber_dana')->toArray())
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('sumber_dana', $value) : $builder;
                }),

            SelectFilter::make('Metode Pemilihan')
                ->options([
                    '' => 'Semua Metode',
                ] + PaketPekerjaan::distinct()->pluck('metode_pemilihan', 'metode_pemilihan')->toArray())
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('metode_pemilihan', $value) : $builder;
                }),

            NumberFilter::make('Minimal Nilai Pagu')
                ->config([
                    'min' => 0,
                    'step' => 1000000
                ])
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('nilai_pagu', '>=', $value) : $builder;
                }),
        ];
    }

    public function deleteSelected()
    {
        PaketPekerjaan::whereIn('paket_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}
