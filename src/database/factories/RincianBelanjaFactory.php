<?php

namespace Database\Factories;

use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RincianBelanja>
 */
class RincianBelanjaFactory extends Factory
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
            'jenis' => $this->faker->word,
            'uraian' => $this->faker->sentence,
            'qty' => $this->faker->numberBetween(1, 100),
            'satuan' => $this->faker->word,
            'harga_satuan' => $this->faker->numberBetween(1000, 100000),
            'keterangan' => $this->faker->paragraph,
        ];
    }
}
