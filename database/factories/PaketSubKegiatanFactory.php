<?php

namespace Database\Factories;

use App\Models\PaketPekerjaan;
use App\Models\SubKegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaketSubKegiatan>
 */
class PaketSubKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paket_id' => PaketPekerjaan::factory(),
            'sub_kegiatan_id' => SubKegiatan::factory(),
        ];
    }
}
