<?php

namespace Database\Seeders;

use App\Models\JadwalKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalKegiatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalKegiatan::factory()->count(10)->create();
    }
}
