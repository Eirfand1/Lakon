<?php

namespace App\Livewire;

use App\Exports\KontrakExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Kontrak;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;
use Carbon\Carbon;
Carbon::setLocale('id');


class KontrakTable extends DataTableComponent
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
            ->where('kontrak.is_verificated', 1);
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Download excel'
        ];
    }

    public function export() {
         return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }

    public function columns(): array
    {
        return [

            Column::make("Aksi", "kontrak_id")
                ->format(fn($value, $row) => view('pages.admin.riwayat-kontrak.actions', ['kontrak' => $row])),
            Column::make("Nama Paket", "paketPekerjaan.nama_pekerjaan")
                ->sortable()
                ->searchable(),
            Column::make("Nama Penyedia", "penyedia.nama_perusahaan_lengkap")
                ->sortable()
                ->searchable(),
            Column::make("No Kontrak", "paketPekerjaan.nomor_kontrak")
                ->sortable()
                ->searchable(),
            Column::make("Nilai Kontrak")
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => 'Rp. ' . number_format($row->nilai_kontrak,0, '', '.')),
            Column::make("Tanggal Kontrak", "tgl_pembuatan")
                ->sortable()
                ->format(fn ($value) => Carbon::parse($value)->translatedFormat('d F Y'))
                ->searchable(),
            Column::make("Waktu Kontrak (HK)", "waktu_kontrak")
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->waktu_kontrak . ' Hari Kerja'),
            Column::make("Jenis Pengadaan", "paketPekerjaan.jenis_pengadaan")
                ->sortable()
                ->searchable(),
            Column::make("Metode Pemilihan", "paketPekerjaan.metode_pemilihan")
                ->sortable()
                ->searchable(),
            Column::make("Verifikator", "verifikator.nama_verifikator") // Relasi
                ->sortable()
                ->searchable(),
            Column::make("Status", "is_verificated")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        return '<div class="badge text-white badge-success gap-2">Terverifikasi</div>';
                    }
                    return '<div class="badge text-white badge-error gap-2">Belum Terverifikasi</div>';
                })->html(),

        ];
    }
}
