<?php

namespace Database\Seeders;

use DB;
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
        DB::table('verifikator')->insert([
            'nip' => '1234567980123456',
            'user_id' => 3,
            'nama_verifikator' => 'verivikator',
        ]);
        Verifikator::factory()->count(10)->create();
    }
}
