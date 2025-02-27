<?php

namespace Database\Seeders;

use DB;
use App\Models\PaketPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketPekerjaanTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 11,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 12,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, JASA KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konstruksi",
            'jenis_pengadaan' => "tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 13,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 14,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "non_tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 21,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "non_tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 22,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, JASA KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konstruksi",
            'jenis_pengadaan' => "non_tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 23,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "non_tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 24,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "e_catalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 31,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "e_catalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 32,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, JASA KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konstruksi",
            'jenis_pengadaan' => "e_catalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 33,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "e_catalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'kode_paket' => 34,
            'sekolah_id' => 1,
        ]);

        PaketPekerjaan::factory()->count(10)->create();
    }
}
