<?php

namespace Database\Seeders;

use App\Models\SatuanKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanKerjaTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SatuanKerja::factory()->count(1)->create();
    }
}
