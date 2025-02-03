<?php

namespace Database\Seeders;

use App\Models\PaketSubKegiatan;
use App\Models\SubKegiatanPaket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketSubKegiatanTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PaketSubKegiatan::factory()->count(10)->create();
    }
}
