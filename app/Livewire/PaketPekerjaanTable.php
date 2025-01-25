<?php
namespace App\Livewire;

use App\Models\SatuanKerja;
use App\Models\SubKegiatan;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\PaketPekerjaan;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class PaketPekerjaanTable extends DataTableComponent
{
    protected $model = PaketPekerjaan::class;

    public function configure(): void
    {
        $this->setPrimaryKey('paket_id')
             ->setDefaultSort('created_at', 'desc')
             ->setColumnSelectStatus(true)
             ->setFilterLayout('slide-down');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make('Paket ID', 'paket_id')
                ->sortable(),
            
            Column::make('Nama Pekerjaan', 'nama_pekerjaan')
                ->sortable()
                ->searchable(),

            Column::make('Sub Kegiatan', 'subKegiatan.nama_sub_kegiatan')
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

            Column::make('Waktu Paket', 'waktu_paket')
                ->sortable()
                ->searchable(),

            Column::make('Metode Pemilihan', 'metode_pemilihan')
                ->sortable()
                ->searchable(),

            Column::make('Jenis Pengadaan', 'jenis_pengadaan')
                ->sortable()
                ->searchable(),

            Column::make('Nilai Pagu', 'nilai_pagu')
                ->sortable()
                ->searchable(),

            Column::make('Nilai HPS', 'nilai_hps')
                ->sortable()
                ->searchable(),

            Column::make('Ppkom', 'ppkom.nama')
                ->sortable()
                ->searchable(),

            Column::make('Dasar Hukum', 'dasarHukum.dasar_hukum')
                ->sortable()
                ->searchable(),

            Column::make('Nilai Pagu')
                ->format(fn($value, $row) => 'Rp ' . number_format($row->nilai_pagu, 2)),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Hapus Terpilih',
        ];
    }

    public function filters(): array{
        return [
            // Satuan Kerja Filter
            TextFilter::make('Satuan Kerja')
            ->config([
                'placeholder' => 'Cari Satuan Kerja',
            ])
            ->filter(function($builder, $value) {
                return $builder->whereHas('satuanKerja', function($query) use ($value) {
                    $query->where('nama_pimpinan', 'like', '%'.$value.'%');
                });
            }), 

            // Sub Kegiatan Filter
            SelectFilter::make('Sub Kegiatan')
                ->options([
                    '' => 'Semua Sub Kegiatan',
                ] + SubKegiatan::pluck('nama_sub_kegiatan', 'nama_sub_kegiatan')->toArray())
                ->filter(function($builder, $value) {
                    return $value
                        ? $builder->whereHas('subKegiatan', fn($q) => $q->where('nama_sub_kegiatan', $value))
                        : $builder;
                }),

            // Tahun Anggaran Filter
            SelectFilter::make('Tahun Anggaran')
                ->options([
                    '' => 'Semua Tahun',
                ] + PaketPekerjaan::distinct()->pluck('tahun_anggaran', 'tahun_anggaran')->toArray()),


            // Metode Pemilihan Filter
            SelectFilter::make('Metode Pemilihan')
                ->options([
                    '' => 'Semua Metode',
                ] + PaketPekerjaan::distinct()->pluck('metode_pemilihan', 'metode_pemilihan')->toArray()),

            // Jenis Pengadaan Filter
            SelectFilter::make('Jenis Pengadaan')
                ->options([
                    '' => 'Semua Jenis',
                ] + PaketPekerjaan::distinct()->pluck('jenis_pengadaan', 'jenis_pengadaan')->toArray()),

            // Nilai Pagu Filter
            NumberFilter::make('Minimal Nilai Pagu')
                ->config([
                    'min' => 0,
                    'step' => 1000000
                ])
                ->filter(function($builder, $value) {
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
