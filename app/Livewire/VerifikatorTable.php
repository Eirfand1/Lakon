<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Verifikator;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class VerifikatorTable extends DataTableComponent
{
    protected $model = Verifikator::class;

    public function configure(): void
    {
        $this->setPrimaryKey('verifikator_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setDefaultSort('verifikator_id', 'desc');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Verifikator::query()
            ->with('user')
            ->orderByDesc('verifikator.updated_at');
    }

    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),
            Column::make("Nip", "nip")
                ->sortable()
                ->searchable(),
            Column::make("Nama verifikator", "nama_verifikator")
                ->sortable()
                ->searchable(),
            Column::make("Username", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "user.email")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->searchable(),
            Column::make("Aksi", "verifikator_id")
                ->format(
                    fn($value, $row, Column $column) =>
                    view('pages.admin.verifikator.actions', [
                        'verifikator' => Verifikator::find($value)
                    ])
                ),
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
        Verifikator::whereIn('verifikator_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}


