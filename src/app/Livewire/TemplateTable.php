<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Template;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class TemplateTable extends DataTableComponent
{
    protected $model = Template::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("File Name", "file_path")
                ->format(function ($value, $row, Column $column) {
                    return basename($value);
                })
                ->sortable()
                ->searchable(),

            Column::make("Aksi", "id")
                ->format(
                    fn($value, $row, Column $column) =>
                    view('pages.admin.template.actions', [
                        'template' => Template::find($value)
                    ])
                ),

        ];
    }
}
