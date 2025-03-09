<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sekolah')->insert([
            'npsn' => 12345,
            'nama_sekolah' => "SDN karangkemiri 02",
            'jenjang' => "SD",
            'status' => "Negeri",
            'kepala_sekolah' => "Budi",
            'nip_kepala_sekolah' => 1234567890,
            'alamat' => "Jl. Karya Asri No. 1, Karang Kemiri, Kec. Karang Kemiri, Kabupaten Malang, Jawa Timur 65156",
            'desa' => "Karang Kemiri",
            'kecamatan' => "Maos",
            'koordinat' => DB::raw("ST_GeomFromText('POINT(-110.000000 -8.000000)')"),
        ]);
        Sekolah::factory()->count(10)->create();
    }
}
