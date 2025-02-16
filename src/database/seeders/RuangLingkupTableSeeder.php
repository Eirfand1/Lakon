<?php

namespace Database\Seeders;

use App\Models\RuangLingkup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangLingkupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RuangLingkup::factory()->count(10)->create();
    }
}
