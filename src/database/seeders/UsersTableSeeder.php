<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert([
        'name'=> 'admin',
        'email'=> 'admin@gmail.com',
        'role' => 'admin',
        'password'=> bcrypt('123456789'),
       ]);

       // Data user penyedia
       DB::table('users')->insert([
        'name' => 'penyedia',
        'email' => 'penyedia@gmail.com',
        'role' => 'penyedia',
        'password' => bcrypt('123456789'),
        ]);

        // Data user verifikator
        DB::table('users')->insert([
            'name' => 'verifikator',
            'email' => 'verifikator@gmail.com',
            'role' => 'verifikator',
            'password' => bcrypt('123456789'),
        ]);
    }
}
