<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubKegiatan>
 */
class SubKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_rekening' => $this->faker->numerify('######'),
            'nama_sub_kegiatan' => $this->faker->sentence(),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'PAUD']),
        ];
    }
}
