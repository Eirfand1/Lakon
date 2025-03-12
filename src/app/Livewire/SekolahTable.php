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

    protected $lazy = true;

    public function configure(): void
    {
        $this->setPrimaryKey('sekolah_id')
             ->setFilterLayout('slide-down')
             ->setPerPageAccepted([10,25,50,100, -1]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder{
        return Sekolah::query()
            ->selectRaw('*, ST_X(koordinat) as lat, ST_Y(koordinat) as lng')
            ->orderByDesc('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make("Aksi", "sekolah_id")
                ->format(function ($value, $row) {
                    // Ambil latitude dan longitude dari kolom koordinat
                    $lat = $row->lat;
                    $lng = $row->lng;

                    if ($lat === null || $lng === null) {
                        $row->koordinat = "-";
                    }else {
                        // gabungkan koordinat menjadi string
                        $row->koordinat = "$lat,$lng";
                    }

                    return view('pages.admin.sekolah.actions', ['sekolah' => $row]);
                }),

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
                    if ($lat === null || $lng === null) {
                        $mapsUrl = "-";
                    }else {
                        $mapsUrl = "<a href='https://www.google.com/maps?q={$lat},{$lng}' target='_blank'>{$lat}, {$lng}</a>";
                    }

                    // Tampilkan tautan yang dapat diklik
                    return $mapsUrl;
                })
                ->html()
                ->searchable()
                ->sortable(),

            
                // ->format(fn($value, $row) => view('pages.admin.sekolah.actions', ['sekolah' => $row])),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Jenjang')
                ->options([
                    '' => 'Semua Jenjang',
                    'PAUD' => 'PAUD',
                    'SD' => 'SD',
                    'SMP' => 'SMP',
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
