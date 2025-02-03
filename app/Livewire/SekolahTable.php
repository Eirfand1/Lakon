<?php
namespace App\Livewire;

use App\Models\Sekolah;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\IncrementColumn;

class SekolahTable extends DataTableComponent
{
    protected $model = Sekolah::class;

    public function configure(): void
    {
        $this->setPrimaryKey('sekolah_id')
             ->setFilterLayout('slide-down');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder{
        return Sekolah::query()
            ->selectRaw('*, ST_X(koordinat) as lat, ST_Y(koordinat) as lng')
            ->orderByDesc('updated_at');
    }

    public function columns(): array
    {
        return [
            IncrementColumn::make('#'),

            Column::make("NPSN","npsn")
                ->searchable()
                ->sortable(),

            Column::make("Nama Sekolah","nama_sekolah")
                ->searchable()
                ->sortable(),

            Column::make("Jenjang","jenjang")
                ->searchable()
                ->sortable(),

            Column::make("Status","status")
                ->searchable()
                ->sortable(),

            Column::make("Alamat","alamat")
                ->searchable()
                ->sortable(),

            Column::make("Desa","desa")
                ->searchable()
                ->sortable(),

            Column::make("Kecamatan","kecamatan")
                ->searchable()
                ->sortable(),

            Column::make("Koordinat","koordinat")
                ->format(function ($value, $row) {
                    // Ambil latitude dan longitude dari kolom koordinat
                    $lat = $row->lat;
                    $lng = $row->lng;

                    // Buat tautan ke Google Maps
                    $mapsUrl = "https://www.google.com/maps?q={$lat},{$lng}";

                    // Tampilkan tautan yang dapat diklik
                    return "<a href='{$mapsUrl}' target='_blank'>{$lat}, {$lng}</a>";
                })
                ->html()
                ->searchable()
                ->sortable(),

            Column::make("Aksi", "sekolah_id")
                ->format(function ($value, $row) {
                    // Ambil latitude dan longitude dari kolom koordinat
                    $lat = $row->lat;
                    $lng = $row->lng;

                    // gabungkan koordinat menjadi string
                    $row->koordinat = "$lat,$lng";

                    return view('pages.admin.sekolah.actions', ['sekolah' => $row]);
                })
                // ->format(fn($value, $row) => view('pages.admin.sekolah.actions', ['sekolah' => $row])),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Jenjang')
                ->options([
                    '' => 'Semua Jenjang',
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                    'SMK' => 'SMK',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('jenjang', $value) : $builder;
                }),

            SelectFilter::make('Status')
                ->options([
                    '' => 'Semua Status',
                    'SWASTA' => 'SWASTA',
                    'NEGERI' => 'NEGERI',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('status', $value) : $builder;
                }),

            TextFilter::make('Desa')
                ->config([
                    'placeholder' => 'Cari Desa',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('desa', 'like', "%$value%") : $builder;
                }),

            TextFilter::make('Kecamatan')
                ->config([
                    'placeholder' => 'Cari Kecamatan',
                ])
                ->filter(function($builder, $value) {
                    return $value ? $builder->where('kecamatan', 'like', "%$value%") : $builder;
                }),
        ];
    }
}
