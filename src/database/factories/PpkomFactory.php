<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ppkom>
 */
class PpkomFactory extends Factory
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
            'nama' => $this->faker->name(),
            'pangkat'=> $this->faker->randomElement(['Ketua', 'Anggota']),
            'jabatan'=> $this->faker->randomElement(['Ketua', 'Anggota']),
            'alamat'=> $this->faker->address(),
            'no_telp'=> $this->faker->phoneNumber(),
            'email'=> $this->faker->email(),
        ];
    }
}
