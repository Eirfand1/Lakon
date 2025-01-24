<?php

namespace Database\Seeders;

use App\Models\Penyedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penyedia::factory()->count(10)->create();
    }
}
