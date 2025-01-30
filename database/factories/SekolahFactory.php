<?php

namespace Database\Factories;

use DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sekolah>
 */
class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $latitude = fake()->latitude();
        $longitude = fake()->longitude();
        return [
            
            'npsn' => (string) $this->faker->randomNumber(8, true),
            'nama_sekolah' => $this->faker->name(),
            'jenjang' => $this->faker->randomElement(['SD', 'SMP', 'SMK', 'SMA']),
            'status' => $this->faker->randomElement(['swasta', 'negeri']),
            'alamat' => $this->faker->address(),
            'desa' => $this->faker->name(),
            'kecamatan' => $this->faker->name(),
            'koordinat' => DB::raw("ST_GeomFromText('POINT($longitude $latitude)')"),
        ];
    }
}
