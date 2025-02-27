<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DashboardTableSeeder::class,
            SekolahSeeder::class,
            UsersTableSeeder::class,
            PenyediaSeeder::class,
            VerifikatorSeeder::class,
            DasarHukumTable::class,
            PpkomTable::class,
            SatuanKerjaTable::class,
            SubKegiatanTable::class,
            PaketPekerjaanTable::class,
            PaketSubKegiatanTable::class,
            KontrakSeeder::class,
        ]);
    }
}
