<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Penyedia;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
class PenyediaTable extends DataTableComponent
{
    protected $model = Penyedia::class;

    public function configure(): void
    {
        $this->setPrimaryKey('penyedia_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make('ID', 'penyedia_id')
                ->sortable(),
            Column::make("NIK", "NIK")
                ->sortable()
                ->searchable(),
            Column::make("Nama Pemilik", "nama_pemilik")
                ->sortable()
                ->searchable(),
            Column::make("Alamat Pemilik", "alamat_pemilik")
                ->sortable()
                ->searchable(),
            Column::make("Nama Perusahaan Lengkap", "nama_perusahaan_lengkap")
                ->sortable()
                ->searchable(),
            Column::make("Nama Perusahaan Singkat", "nama_perusahaan_singkat")
                ->sortable()
                ->searchable(),
            Column::make("No. Akta Notaris", "akta_notaris_no")
                ->sortable()
                ->searchable(),
            Column::make("Nama Akta Notaris", "akta_notaris_nama")
                ->sortable()
                ->searchable(),
            Column::make("Tanggal Akta Notaris", "akta_notaris_tanggal")
                ->sortable()
                ->searchable(),
            Column::make("Alamat Perusahaan", "alamat_perusahaan")
                ->sortable()
                ->searchable(),
            Column::make("Kontak HP", "kontak_hp")
                ->sortable()
                ->searchable(),
            Column::make("Kontak Email", "kontak_email")
                ->sortable()
                ->searchable(),
            Column::make("No Rekenening", "rekening_norek")
                ->sortable()
                ->searchable(),
            Column::make("No Rekenening", "rekening_nama")
                ->sortable()
                ->searchable(),
            Column::make("Bank Rekenening", "rekening_bank")
                ->sortable()
                ->searchable(),
            Column::make("NPWP Perusahaan", "npwp_perusahaan")
                ->sortable()
                ->searchable(),
            Column::make("Logo perusahaan", "logo_perusahaan")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make("Aksi", "penyedia_id")
                ->format(fn($value, $row) => view('pages.admin.penyedia.actions', ['p' => $row])),
        ];
    }

    public function filters(): array{
        $perusahaanOption = Penyedia::distinct()->pluck('nama_perusahaan_lengkap', 'nama_perusahaan_lengkap')->toArray();
        return [
            TextFilter::make('Nama')
                ->config([
                    'placeholder' => 'Cari Nama',
                ])
                ->filter(function($builder, $value) {
                    return $builder->where('nama', 'like', '%' . $value . '%');
                }),
            

            SelectFilter::make('Perusahaan')
                ->options(['' => 'Semua Perusahaan'] + $perusahaanOption) // Menambahkan opsi perusahaan dari database
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('nama_perusahaan_lengkap', $value) : $builder;
                }),
        ];
    }
}
