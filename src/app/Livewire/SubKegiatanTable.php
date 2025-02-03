<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubKegiatan;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class SubKegiatanTable extends DataTableComponent
{
    protected $model = SubKegiatan::class;

    public function configure(): void
    {
        $this->setPrimaryKey('sub_kegiatan_id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder{
        return SubKegiatan::query()->orderByDesc('updated_at');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("No Rekening ", "no_rekening")
                ->sortable()
                ->searchable(),
            Column::make("Nama Sub Kegiatan", "nama_sub_kegiatan")
                ->sortable()
                ->searchable(),
            Column::make("Gabungan", "gabungan")
                ->sortable()
                ->searchable(),
            Column::make("Pendidikan", "pendidikan")
                ->sortable()
                ->searchable(),
            Column::make("Aksi", "sub_kegiatan_id")
                ->format(fn($value, $row) => view('pages.admin.sub-kegiatan.actions', ['sub_kegiatan' => $row])),
        ];
    }
}
