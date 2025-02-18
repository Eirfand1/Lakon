<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DasarHukum;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Livewire\Attributes\On; // Tambahkan ini

class DasarHukumTable extends DataTableComponent
{
    protected $model = DasarHukum::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('daskum_id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder{
        return DasarHukum::query()->orderByDesc('updated_at');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Dasar Hukum ", "dasar_hukum")
                ->sortable()
                ->searchable(),
            Column::make("Aksi", "daskum_id")
                ->format(fn($value, $row) => view('pages.admin.dasar-hukum.actions', ['daskum' => $row])),
        ];
    }

    // Dengarkan event `dasarHukumSaved`
    #[On('dasarHukumSaved')]
    public function refreshTable()
    {
        
    }
}
