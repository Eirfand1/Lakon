<?php

namespace Database\Seeders;

use App\Models\Ppkom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PpkomTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Ppkom::factory()->count(10)->create();
    }
}
