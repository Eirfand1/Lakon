<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DasarHukum;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class DasarHukumTable extends DataTableComponent
{
    protected $model = DasarHukum::class;

    public function configure(): void
    {
        $this->setPrimaryKey('daskum_id');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'), 
            Column::make("Dasar Hukum ", "dasar_hukum")
                ->sortable()
                ->searchable(),
            
        ];
    }
}
