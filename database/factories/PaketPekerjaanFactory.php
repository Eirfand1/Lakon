<?php

namespace Database\Factories;

use App\Models\DasarHukum;
use App\Models\Ppkom;
use App\Models\SatuanKerja;
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
            'sumber_dana' => $this->faker->word(),
            'tahun_anggaran' => $this->faker->year(),
            'satker_id' => SatuanKerja::factory(),
            'nama_pekerjaan' => $this->faker->sentence(),
            'waktu_paket' => $this->faker->numberBetween(30, 180),
            'metode_pemilihan' => $this->faker->word(),
            'jenis_pengadaan' => $this->faker->randomElement(['tender', 'non_tender', 'e_catalog']),
            'nilai_pagu' => $this->faker->randomFloat(2, 100000, 1000000),
            'nilai_hps' => $this->faker->randomFloat(2, 90000, 950000),
            'ppkom_id' => Ppkom::factory(),
            'daskum_id' => DasarHukum::factory(),
            'kode_paket' => $this->faker->numberBetween(1000,5000)
        ];
    }
}
