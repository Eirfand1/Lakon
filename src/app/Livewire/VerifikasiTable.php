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
            ->setFilterLayout('slide-down')
             ->setPerPageAccepted([10,25,50,100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator', 'paketPekerjaan'])
            ->orderByDesc('kontrak.updated_at')
            ->where('kontrak.is_verificated', 0)
            ->where('kontrak.is_layangkan', 1);
    }

    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),

            Column::make("is_verificated")
                ->hideIf(true),

            Column::make("sekolah_id","paketPekerjaan.sekolah.nama_sekolah")
                ->hideIf(true)
                ->searchable(),

            Column::make("Aksi", "kontrak_id")
                ->format( function($value, $row) {
                    return '
                            <button type="button" onclick="tolak('.$row->kontrak_id.')"
                            class="btn btn-sm btn-error dark:text-gray-50">
                            tolak</button>

                            <a  href="detail/'.$row->kontrak_id.'"
                            class="btn btn-sm btn-info dark:text-gray-50">
                            detail</a>
                            ';
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
