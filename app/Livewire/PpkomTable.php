<?php

namespace App\Livewire;

use App\Models\Ppkom;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PpkomTable extends PowerGridComponent
{
    public string $tableName = 'ppkom-table-uuzoei-table';

    public string $primaryKey = 'ppkom.ppkom_id';
    public string $sortField = 'ppkom.ppkom_id';

    public bool $showFilters = true;
    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns()
                ->withoutLoading(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Ppkom::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('ppkom_id')
            ->add('nip')
            ->add('nama')
            ->add('pangkat')
            ->add('jabatan')
            ->add('alamat')
            ->add('no_telp')
            ->add('email');
    }

    public function columns(): array
    {
        return [
            Column::make('Ppkom id', 'ppkom_id'),
            Column::make('Nip', 'nip')
                ->sortable()
                ->searchable(),

            Column::make('Nama', 'nama')
                ->sortable()
                ->searchable(),

            Column::make('Pangkat', 'pangkat')
                ->sortable()
                ->searchable(),

            Column::make('Jabatan', 'jabatan')
                ->sortable()
                ->searchable(),

            Column::make('Alamat', 'alamat')
                ->sortable()
                ->searchable(),

            Column::make('No telp', 'no_telp')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
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

             Filter::inputText('jabatan')->placeholder('Jabatan'),
             Filter::inputText('pangkat')->placeholder('pangkat'),

        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Ppkom $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->ppkom_id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->ppkom_id])
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
