<?php

namespace Database\Factories;

use App\Models\PaketPekerjaan;
use App\Models\Penyedia;
use App\Models\SatuanKerja;
use App\Models\SubKegiatan;
use App\Models\Verifikator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kontrak>
 */
class KontrakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'no_kontrak' => strtoupper($this->faker->bothify('KON-####-????')),
            'jenis_kontrak' => $this->faker->randomElement(['Pengadaan Barang', 'Pengadaan Jasa', 'Pengadaan Lainnya']),
            'nilai_kontrak' => $this->faker->numberBetween(1000, 5000),
            'tgl_kontrak' => $this->faker->date(),
            'paket_id' => PaketPekerjaan::factory(),
            'tgl_pembuatan' => $this->faker->date(),
            'satker_id' => SatuanKerja::factory(),
            'sub_kegiatan_id' => SubKegiatan::factory(),
            'penyedia_id' => Penyedia::factory(),
            'nomor_dppl' => $this->faker->numberBetween(1000,5000),
            'tgl_dppl' => $this->faker->date(),
            'nomor_bahpl' => strtoupper($this->faker->bothify('BAHPL-####')),
            'tgl_bahpl' => $this->faker->date(),
            'verifikator_id' => Verifikator::factory(),
            'is_verificated' => $this->faker->boolean(),
            'tanggal_awal' => $this->faker->date(),
            'tanggal_akhir' => $this->faker->date()
        ];
    }
}
