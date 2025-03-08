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
            'kode_sirup' => 11,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 11,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 12,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 12,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 13,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, PEKERJAAN KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pekerjaan Konstruksi",
            'jenis_pengadaan' => "Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 13,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 14,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "TENDER, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 14,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 21,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "Non Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 21,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 22,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "Non Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 22,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 23,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, PENKERJAAN KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pekerjaan Konstruksi",
            'jenis_pengadaan' => "Non Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 23,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 24,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "NON TENDER, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "Non Tender",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 24,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 31,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "E-Katalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 31,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 32,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "E-Katalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 32,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 33,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, PEKERJAAN KONSTRUKSI",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pekerjaan Konstruksi",
            'jenis_pengadaan' => "E-Katalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 33,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 34,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "E-CATALOG, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "E-Katalog",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 34,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 41,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "Swakelola, JASA KONSULTASI PENGAWASAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Pengawasan",
            'jenis_pengadaan' => "Swakelola",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 41,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 42,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "Swakelola, JASA KONSULTASI PERENCANAAN",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Jasa Konsultasi Perencanaan",
            'jenis_pengadaan' => "Swakelola",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 42,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 43,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "Swakelola, Pekerjaan Konstruksi",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pekerjaan Konstruksi",
            'jenis_pengadaan' => "Swakelola",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 43,
            'sekolah_id' => 1,
        ]);
        DB::table('paket_pekerjaan')->insert([
            'kode_sirup' => 44,
            'sumber_dana' => 'APBN',
            'tahun_anggaran' => '2025',
            'satker_id' => 1,
            'nama_pekerjaan' => "Swakelola, PENGADAAN BARANG",
            'waktu_paket' => "2023-01-01",
            'metode_pemilihan' => "Pengadaan Barang",
            'jenis_pengadaan' => "Swakelola",
            'nilai_pagu_paket' => "1000000",
            'nilai_pagu_anggaran' => "1000000",
            'nilai_hps' => "1000000",
            'ppkom_id' => 1,
            'daskum_id' => 1,
            'rup' => 44,
            'sekolah_id' => 1,
        ]);

        PaketPekerjaan::factory()->count(10)->create();
    }
}
