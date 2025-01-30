<?php
namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sekolah;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class SekolahTable extends DataTableComponent
{
    protected $model = Sekolah::class;

    public function configure(): void
    {
        $this->setPrimaryKey('sekolah_id')
             ->setFilterLayout('slide-down');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),

            Column::make("NPSN","npsn")
                ->searchable()
                ->sortable(),

            Column::make("Nama Sekolah","nama_sekolah")
                ->searchable()
                ->sortable(),

            Column::make("Jenjang","jenjang")
                ->searchable()
                ->sortable(),

            Column::make("Status","status")
                ->searchable()
                ->sortable(),

            Column::make("Alamat","alamat")
                ->searchable()
                ->sortable(),

            Column::make("Desa","desa")
                ->searchable()
                ->sortable(),

            Column::make("Kecamatan","kecamatan")
                ->searchable()
                ->sortable(),

            Column::make("Koordinat","koordinat")
                ->searchable()
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Jenjang')
                ->options([
                    '' => 'Semua Jenjang',
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                    'SMK' => 'SMK',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('jenjang', $value) : $builder;
                }),

            SelectFilter::make('Status')
                ->options([
                    '' => 'Semua Status',
                    'SWASTA' => 'SWASTA',
                    'NEGERI' => 'NEGERI',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('status', $value) : $builder;
                }),

            TextFilter::make('Desa')
                ->config([
                    'placeholder' => 'Cari Desa',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('desa', 'like', "%$value%") : $builder;
                }),

            TextFilter::make('Kecamatan')
                ->config([
                    'placeholder' => 'Cari Kecamatan',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('kecamatan', 'like', "%$value%") : $builder;
                }),
        ];
    }
}
