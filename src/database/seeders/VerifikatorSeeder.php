<?php

namespace Database\Seeders;

use App\Models\Verifikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerifikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Verifikator::factory()->count(10)->create();
    }
}
