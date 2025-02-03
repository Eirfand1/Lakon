<?php

namespace Database\Seeders;

use App\Models\PaketPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketPekerjaanTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PaketPekerjaan::factory()->count(10)->create();
    }
}
