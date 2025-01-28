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
        'password'=> bcrypt('JunAedi99Gacor'),
       ]);
    }
}
