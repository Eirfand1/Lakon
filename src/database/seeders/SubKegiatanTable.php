<?php

namespace Database\Seeders;

use App\Models\SubKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKegiatanTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SubKegiatan::factory()->count(10)->create();
    }
}
