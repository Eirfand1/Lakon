<?php

namespace Database\Seeders;

use App\Models\DasarHukum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DasarHukumTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DasarHukum::factory()->count(10)->create();
    }
}
