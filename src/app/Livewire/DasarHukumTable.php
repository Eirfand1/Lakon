<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DasarHukum;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class DasarHukumTable extends DataTableComponent
{
    protected $model = DasarHukum::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('daskum_id')
            ->setPerPageAccepted([10,25,50,100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder{
        return DasarHukum::query()->orderByDesc('tahun');
    }

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Hapus Terpilih',
        ];
    }

    public function deleteSelected()
    {
        DasarHukum::whereIn('daskum_id', $this->getSelected())->delete();
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Aksi", "daskum_id")
                ->format(fn($value, $row) => view('pages.admin.dasar-hukum.actions', ['daskum' => $row])),
            Column::make("Tahun", "tahun")
                ->sortable()
                ->searchable(),
            Column::make("Dasar Hukum ", "dasar_hukum")
                ->sortable()
                ->searchable()
                ->format(fn($value) => '<div class="w-full whitespace-normal break-words">' . e($value) . '</div>')
                ->html(),

        ];
    }
}
