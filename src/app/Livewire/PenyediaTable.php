<?php

namespace App\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Penyedia;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
Carbon::setLocale('id');
class PenyediaTable extends DataTableComponent
{
    protected $model = Penyedia::class;

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('penyedia_id')
            ->setColumnSelectStatus(true)
            ->setFilterLayout('slide-down')
            ->setPerPageAccepted([10,25,50,100, -1]);
    }
    public function builder(): \Illuminate\Database\Eloquent\Builder {
        return Penyedia::query()->orderByDesc('penyedia.updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make("Aksi", "penyedia_id")
                ->format(fn($value, $row) => view('pages.admin.penyedia.actions', ['p' => Penyedia::with('user')->find($value)])),
            Column::make("Verifikasi", "is_verificated")
                ->format(fn($value, $row) => view('pages.admin.penyedia.status', ['status' => $value, 'id' => $row->penyedia_id])),
            Column::make("Nama Perusahaan Lengkap", "nama_perusahaan_lengkap")
                ->sortable()
                ->searchable(),
            Column::make("Nama Perusahaan Singkat", "nama_perusahaan_singkat")
                ->sortable()
                ->searchable(),
            Column::make("Username", "user.name")
                ->sortable()
                ->searchable(),
            Column::make('Status Akun', 'status')
                ->sortable()
                ->searchable(),
            Column::make("NIK", "NIK")
                ->sortable()
                ->searchable(),
            Column::make("Nama Pemilik", "nama_pemilik")
                ->sortable()
                ->searchable(),
            Column::make("Alamat Pemilik", "alamat_pemilik")
                ->sortable()
                ->searchable(),

            Column::make("No. Akta Notaris", "akta_notaris_no")
                ->sortable()
                ->searchable(),
            Column::make("Nama Akta Notaris", "akta_notaris_nama")
                ->sortable()
                ->searchable(),
            Column::make("Tanggal Akta Notaris", "akta_notaris_tanggal")
                ->format(fn($value) => Carbon::parse($value)->translatedFormat('d F Y'))
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
            // Column::make("Logo perusahaan", "logo_perusahaan")
            //     ->sortable()
            //     ->searchable()
            //     ->format(function ($value, $row) {
            //        return "<img src='" . asset($value) ."' alt='' style='width: auto; height: 30px;' />";
            //     })
            //     ->html(),
        ];
    }

    public function filters(): array
    {
        $perusahaanOption = Penyedia::distinct()->pluck('nama_perusahaan_lengkap', 'nama_perusahaan_lengkap')->toArray();
        $statusOption = Penyedia::distinct()->pluck('status', 'status')->toArray();
        return [
            TextFilter::make('Nama')
                ->config([
                    'placeholder' => 'Cari Nama',
                ])
                ->filter(function ($builder, $value) {
                    return $builder->where('nama_pemilik', 'like', '%' . $value . '%');
                }),


            SelectFilter::make('Perusahaan')
                ->options(['' => 'Semua Perusahaan'] + $perusahaanOption) // Menambahkan opsi perusahaan dari database
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('nama_perusahaan_lengkap', $value) : $builder;
                }),

            SelectFilter::make('Status Akun')
                ->options(['' => 'Semua Status'] + $statusOption)
                ->filter(function ($builder, $value) {
                    return $value ? $builder->where('status', $value) : $builder;
                }),
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
        Penyedia::whereIn('penyedia_id', $this->getSelected())->delete();
        $this->clearSelected();
    }
}
