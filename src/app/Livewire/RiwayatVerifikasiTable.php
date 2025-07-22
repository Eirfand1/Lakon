<?php

namespace App\Livewire;

use App\Exports\KontrakExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Kontrak;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RiwayatVerifikasiTable extends DataTableComponent
{
    protected $model = Kontrak::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('kontrak_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setPerPageAccepted([10, 25, 50, 100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Kontrak::query()
            ->with(['satuanKerja', 'penyedia', 'verifikator', 'paketPekerjaan'])
            ->orderByDesc('kontrak.updated_at')
            ->where('kontrak.is_verificated', 1)
            ->where('verifikator_id', Auth::user()->verifikator->verifikator_id);
    }

    public function columns(): array
    {
        return [

            IncrementColumn::make('#'),

            Column::make("Aksi", "kontrak_id")
                ->format(function ($value, $row) {
                    return '
                       <div class="flex gap-1">
                            <a href="riwayat-kontrak/' . $row->kontrak_id . '" class="btn rounded-md flex  btn-sm bg-blue-500 text-white" wire:navigate>
                                <i class="fa fa-eye text-sm inline">
                                </i>
                            </a>
                            <a href="detail/' . $row->kontrak_id . '" class="btn rounded-md flex  btn-sm btn-warning text-white" wire:navigate>
                                <i class="fa fa-pen text-sm inline">
                                </i>
                            </a>
                       </div>
                        ';
                })->html(),

            Column::make("Nama Paket", "paketPekerjaan.nama_pekerjaan")
                ->sortable()
                ->searchable(),

            Column::make("Nama Penyedia", "penyedia.nama_perusahaan_lengkap")
                ->sortable()
                ->searchable(),

            Column::make("No Kontrak", "paketPekerjaan.nomor_kontrak")
                ->sortable()
                ->searchable(),

            Column::make("Nilai Kontrak", "nilai_kontrak")
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => 'Rp. ' . number_format($row->nilai_kontrak, 2)),

            Column::make("Tanggal Kontrak", "tgl_pembuatan")
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->translatedFormat('d F Y'))
                ->searchable(),

            Column::make("Waktu Kontrak (HK)", "waktu_kontrak")
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->waktu_kontrak . ' Hari Kerja'),

            Column::make("Jenis Pengadaan", "paketPekerjaan.metode_pemilihan")
                ->sortable()
                ->searchable(),

            Column::make("Metode Pengadaan", "paketPekerjaan.jenis_pengadaan")
                ->sortable()
                ->searchable(),

            Column::make("Tanggal Pengajuan", "tgl_pembuatan")
                ->sortable()
                ->searchable()
                ->format(fn ($value) => Carbon::parse($value)->translatedFormat('d F Y')),

            Column::make("is_verificated")
                ->hideIf(true),

            Column::make("sekolah_id", "paketPekerjaan.sekolah.nama_sekolah")
                ->hideIf(true)
                ->searchable(),
        ];
    }
}
