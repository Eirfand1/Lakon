<?php

namespace Database\Factories;

use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RuangLingkup>
 */
class RuangLingkupFactory extends Factory
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
            'ruang_lingkup' => $this->faker->sentence,
        ];
    }
}
