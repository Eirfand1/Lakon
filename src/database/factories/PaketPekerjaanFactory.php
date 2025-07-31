<?php

namespace Database\Factories;

use App\Models\DasarHukum;
use App\Models\Ppkom;
use App\Models\SatuanKerja;
use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaketPekerjaan>
 */
class PaketPekerjaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_matrik' => $this->faker->numberBetween(1000,5000),
            'kode_sirup' => $this->faker->numberBetween(1000,5000),
            'sumber_dana' => $this->faker->randomElement(['APBD', 'DAK', 'BANKEU', 'APBD Perubahan', 'APBD Perubahan Biasa', 'BANKEU Perubahan', 'SG', 'Bantuan Pemerintah']),
            'tahun_anggaran' => $this->faker->year(),
            'satker_id' => SatuanKerja::factory(),
            'nama_pekerjaan' => $this->faker->sentence(),
            'waktu_paket' => $this->faker->date(),
            'metode_pemilihan' => $this->faker->randomElement(['Jasa Konsultansi Pengawasan', 'Jasa Konsultansi Perencanaan', 'Pekerjaan Konstruksi', 'Pengadaan Barang']),
            'jenis_pengadaan' => $this->faker->randomElement(['Tender', 'Non Tender', 'E-Katalog', 'Swakelola']),
            'nilai_pagu_paket' => $this->faker->randomFloat(2, 100000, 1000000),
            'nilai_pagu_anggaran' => $this->faker->randomFloat(2, 100000, 1000000),
            'nilai_hps' => $this->faker->randomFloat(2, 90000, 950000),
            'ppkom_id' => Ppkom::factory(),
            'daskum_id' => DasarHukum::factory(),
            'sekolah_id' => Sekolah::factory()
        ];
    }
}
