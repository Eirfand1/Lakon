<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use App\Models\SatuanKerja;

class SatuanKerjaTable extends DataTableComponent
{
    protected $model = SatuanKerja::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('satker_id')
             ->setColumnSelectStatus(true)
             ->setFilterLayout('slide-down')
             ->setPerPageAccepted([10, 25, 50, 100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return SatuanKerja::query()->orderByDesc('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make("Aksi", "satker_id")
                ->format(fn($value, $row) => view('pages.admin.satuan-kerja.actions', ['satker' => $row])),
            Column::make("NIP", "nip")
                ->sortable()
                ->searchable(),
            Column::make("Nama Pimpinan", "nama_pimpinan")
                ->sortable()
                ->searchable(),
            Column::make("Jabatan", "jabatan")
                ->sortable()
                ->searchable(),
            Column::make("Website", "website")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Telepon", "telp")
                ->sortable()
                ->searchable(),
            Column::make("KLPD", "klpd")
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Nama Pimpinan')
                ->config([
                    'placeholder' => 'Cari Nama Pimpinan',
                ])
                ->filter(function($builder, $value) {
                    return $builder->where('nama_pimpinan', 'like', '%' . $value . '%');
                }),

            TextFilter::make('NIP')
                ->config([
                    'placeholder' => 'Cari NIP',
                ])
                ->filter(function($builder, $value) {
                    return $builder->where('nip', 'like', '%' . $value . '%');
                }),
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
        SatuanKerja::whereIn('satker_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}
