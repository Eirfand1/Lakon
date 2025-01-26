<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use App\Models\Ppkom;

class PpkomTable extends DataTableComponent
{
    protected $model = Ppkom::class;

    public function configure(): void
    {
        $this->setPrimaryKey('ppkom_id')
             ->setDefaultSort('ppkom_id', 'desc')
             ->setColumnSelectStatus(true)
             ->setFilterLayout('slide-down');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("ID", "ppkom_id")
                ->sortable(),
            Column::make("NIP", "nip")
                ->sortable()
                ->searchable(),
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("Pangkat", "pangkat")
                ->sortable()
                ->searchable(),
            Column::make("Jabatan", "jabatan")
                ->sortable()
                ->searchable(),
            Column::make("Alamat", "alamat")
                ->sortable()
                ->searchable(),

            Column::make("No Telp", "no_telp")
                ->sortable()
                ->searchable(),

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Aksi", "ppkom_id")
                ->format(fn($value, $row) => view('pages.admin.ppkom.actions', ['ppkom' => $row])),
        ];
    }

    public function filters(): array
    {
        $pangkatOptions = Ppkom::distinct()->pluck('pangkat', 'pangkat')->toArray();
        $jabatanOptions = Ppkom::distinct()->pluck('jabatan','jabatan')->toArray();
        return [
            TextFilter::make('Nama')
                ->config([
                    'placeholder' => 'Cari Nama',
                ])
                ->filter(function($builder, $value) {
                    return $builder->where('nama', 'like', '%' . $value . '%');
                }),
            

            SelectFilter::make('Pangkat')
                ->options(['' => 'Semua Pangkat'] + $pangkatOptions) // Menambahkan opsi pangkat dari database
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('pangkat', $value) : $builder;
                }),

            SelectFilter::make('Jabatan')
                ->options(['' => 'Semua Jabatan'] + $jabatanOptions) // Menambahkan opsi pangkat dari database
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('jabatan', $value) : $builder;
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
        Ppkom::whereIn('ppkom_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}
