<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Verifikator;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class VerifikatorTable extends DataTableComponent
{
    protected $model = Verifikator::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('verifikator_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setPerPageAccepted([10,25,50,100, -1]);
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

            Column::make("Aksi", "verifikator_id")
                ->format(
                    fn($value, $row, Column $column) =>
                    view('pages.admin.verifikator.actions', [
                        'verifikator' => Verifikator::find($value)
                    ])
                ),
            
            Column::make("Nama verifikator", "nama_verifikator")
                ->sortable()
                ->searchable(),

            Column::make("Nip", "nip")
                ->sortable()
                ->searchable(),
            Column::make("Username", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "user.email")
                ->sortable()
                ->searchable(),
            
            
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


