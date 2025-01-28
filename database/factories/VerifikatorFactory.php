<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Verifikator>
 */
class VerifikatorFactory extends Factory
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
            'nip' => $this->faker->numberBetween(1000000,5000000),
            'user_id' => User::factory(),
            'nama_verifikator' => $this->faker->name(),
        ];
    }
}
