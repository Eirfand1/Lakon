<?php

namespace Database\Factories;

use App\Models\Kontrak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tim>
 */
class TimFactory extends Factory
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
            'nama' => $this->faker->name,
            'posisi' => $this->faker->jobTitle,
            'status_tenaga' => $this->faker->randomElement(['Tenaga Ahli', 'Tenaga Penunjang']),
            'bulan_1' => $this->faker->boolean,
            'bulan_2' => $this->faker->boolean,
            'bulan_3' => $this->faker->boolean,
            'bulan_4' => $this->faker->boolean,
            'bulan_5' => $this->faker->boolean,
            'bulan_6' => $this->faker->boolean,
            'bulan_7' => $this->faker->boolean,
            'bulan_8' => $this->faker->boolean,
            'bulan_9' => $this->faker->boolean,
            'bulan_10' => $this->faker->boolean,
            'bulan_11' => $this->faker->boolean,
            'bulan_12' => $this->faker->boolean,
        ];
    }
}
