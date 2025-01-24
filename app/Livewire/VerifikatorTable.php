<?php

namespace App\Livewire;

use App\Models\Verifikator;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class VerifikatorTable extends PowerGridComponent
{
    public string $tableName = 'verifikator-table-wpihnx-table';
    public string $primaryKey = 'verifikator.verifikator_id';
    public string $sortField = 'verifikator.verifikator_id';
    public bool $showFilters = true;

    public function boot(){
        config(['livewire-powergrid.filter' => 'outside']);
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Verifikator::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('verifikator_id')
            ->add('nip')
            ->add('nama_verifikator')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Verifikator id', 'verifikator_id'),
            Column::make('Nip', 'nip')
                ->sortable()
                ->searchable(),

            Column::make('Nama verifikator', 'nama_verifikator')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
             Filter::inputText('nama_verifikator')->placeholder('Nama Verifikator'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Verifikator $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('delete')
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
