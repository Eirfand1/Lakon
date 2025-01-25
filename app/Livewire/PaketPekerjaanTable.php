<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PaketPekerjaan;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class PaketPekerjaanTable extends DataTableComponent
{
    protected $model = PaketPekerjaan::class;

    public function configure(): void
    {
        $this->setPrimaryKey('paket_id');
    }

    public function query()
    {
        $query =  PaketPekerjaan::query()
            ->with(['subKegiatan', 'satker']); // Include relasi
        
        
        return $query; 
    } 

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),
            Column::make("Paket id", "paket_id")
                ->sortable(),
            Column::make("Sub Kegiatan ID", "sub_kegiatan_id")
                ->sortable(),
            Column::make("Sumber Dana", "sumber_dana")
                ->sortable(),
            Column::make("Tahun Anggaran", "tahun_anggaran")
                ->sortable(),
            Column::make("Satker ID", "satker_id")
                ->sortable(),
            Column::make("Nama Pekerjaan", "nama_pekerjaan")
                ->sortable(),
            Column::make("Waktu Paket", "waktu_paket")
                ->sortable(),
            Column::make("Metode Pemilihan", "metode_pemilihan")
                ->sortable(),
            Column::make("Jenis Pengadaan", "jenis_pengadaan")
                ->sortable(),
            Column::make("Nilai Pagu", "nilai_pagu")
                ->sortable(),
            Column::make("Nilai HPS", "nilai_hps")
                ->sortable(),
            Column::make("Created At", "created_at")
                ->sortable(),
            Column::make("Updated At", "updated_at")
                ->sortable(),
        ];
    }
}
