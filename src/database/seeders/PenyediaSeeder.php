<?php

namespace Database\Seeders;

use DB;
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
        DB::table('penyedia')->insert([
            'user_id' => 2,
            'NIK' => '1234567890123456',
            'status' => 'konsultan',
            'nama_pemilik' => 'penyedia',
            'alamat_pemilik' => 'alamat penyedia',
            'kontak_hp' => '081111111111',
            'kontak_email' => 'penyedia@gmail.com',
            'nama_perusahaan_lengkap' => 'penyedia',
            'nama_perusahaan_singkat' => 'penyedia',
            'akta_notaris_no' => '123456',
            'akta_notaris_nama' => 'notaris penyedia',
            'akta_notaris_tanggal' => '2025-02-25',
            'alamat_perusahaan' => 'alamat_perusahaam',
            'rekening_norek' => '123456789012',
            'rekening_nama' => 'rekening penyedia',
            'rekening_bank' => 'BCA',
            'npwp_perusahaan' => '12.123.123.1-123.123',
        ]);
        
        Penyedia::factory()->count(10)->create();
    }
}
