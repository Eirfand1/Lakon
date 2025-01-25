<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SatuanKerja>
 */
class SatuanKerjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->numerify('##########'),
            'nama_pimpinan' => $this->faker->name(),
            'jabatan' => $this->faker->jobTitle(),
            'website' => $this->faker->url(),
            'email' => $this->faker->email(),
            'telp' => $this->faker->phoneNumber(),
            'klpd' => $this->faker->randomNumber(5, true),
        ];
    }
}
