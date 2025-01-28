<?php

namespace Database\Seeders;

use App\Models\Kontrak;
use Database\Factories\KontrakFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontrakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Kontrak::factory()->count(10)->create();
    }
}
