<?php

namespace Database\Seeders;

use App\Models\Peralatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeralatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Peralatan::factory()->count(10)->create();
    }
}
