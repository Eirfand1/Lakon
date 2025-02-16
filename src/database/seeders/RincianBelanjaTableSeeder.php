<?php

namespace Database\Seeders;

use App\Models\RincianBelanja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RincianBelanjaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RincianBelanja::factory()->count(10)->create();
    }
}
