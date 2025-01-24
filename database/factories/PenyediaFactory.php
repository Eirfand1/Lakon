<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyedia>
 */
class PenyediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'NIK' => $this->faker->numerify('################'), // 16 digit angka acak
            'nama_pemilik' => $this->faker->name(),
            'alamat_pemilik' => $this->faker->address(),
            'kontak_hp' => $this->faker->numerify('############'),
            'kontak_email' => $this->faker->safeEmail(),
            'nama_perusahaan_lengkap' => $this->faker->company(),
            'nama_perusahaan_singkat' => $this->faker->companySuffix(),
            'akta_notaris_no' => $this->faker->numerify('######'), // Nomor acak 6 digit
            'akta_notaris_nama' => $this->faker->name(),
            'akta_notaris_tanggal' => $this->faker->date(),
            'alamat_perusahaan' => $this->faker->address(),
            'rekening_norek' => $this->faker->numerify('############'), // 12 digit angka acak
            'rekening_nama' => $this->faker->name(),
            'rekening_bank' => $this->faker->randomElement(['BCA', 'Mandiri', 'BRI', 'BNI', 'CIMB Niaga']),
            'npwp_perusahaan' => $this->faker->numerify('##.###.###.#-###.###'), // Format NPWP
        ];
    }
}
