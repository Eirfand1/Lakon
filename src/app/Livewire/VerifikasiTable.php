<?php

namespace App\Livewire;

use App\Exports\KontrakExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Kontrak;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class VerifikasiTable extends DataTableComponent
{
    protected $model = Kontrak::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('kontrak_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator', 'paketPekerjaan'])
            ->orderByDesc('kontrak.updated_at');
    }
    
    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),

            Column::make("is_verificated")
                ->hideIf(true),

            Column::make("Tiket", "kontrak_id")
                ->format( function($value, $row) {
                    if($row->is_verificated) {
                        $class = " bg-green-500 hover:bg-green-600 focus:ring-green-500";
                    }else {
                        $class = " bg-red-500 hover:bg-red-600 focus:ring-red-500";
                    }
                    return '<a  href="/detail-permohonan/'.$value.'"
                            class="inline-block px-4 py-2 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 '. $class .'">
                            gak tau apa
                            </a>';
                })->html(),

            Column::make("Nama Perusahaan", "penyedia.nama_perusahaan_lengkap")
                ->sortable()
                ->searchable(),

            Column::make("Nama Paket", "paketPekerjaan.nama_pekerjaan")
                ->sortable()
                ->searchable(),
            
            Column::make("Jenis Pengadaan", "paketPekerjaan.metode_pemilihan")
                ->sortable()
                ->searchable(),
                
            Column::make("Metode Pengadaan", "paketPekerjaan.jenis_pengadaan")
                ->sortable()
                ->searchable(),

            Column::make("Tanggal Pengajuan", "tgl_pembuatan")
                ->sortable()
                ->searchable(),

            Column::make("Aksi", "kontrak_id")
                ->format( function($value, $row) {
                    return '<a  href="#"
                            class="inline-block px-4 py-2 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 bg-red-500 hover:bg-red-600 focus:ring-red-500">
                            tolak permohonan
                            </a>';
                })->html(),
        ];
    }
}
