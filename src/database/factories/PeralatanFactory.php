<?php

namespace Database\Factories;

use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peralatan>
 */
class PeralatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kontrak_id' => Kontrak::factory(),
            'nama_peralatan' => $this->faker->word,
            'merk' => $this->faker->company,
            'type' => $this->faker->word,
            'kapasitas' => $this->faker->word,
            'jumlah' => $this->faker->numberBetween(1, 10),
            'kondisi' => $this->faker->randomElement(['Baik', 'Sedang', 'Rusak']),
            'status_kepemilikan' => $this->faker->word,
            'keterangan' => $this->faker->paragraph,
        ];
    }
}
