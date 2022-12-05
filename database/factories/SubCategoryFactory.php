<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['bed pasien', 'unit alat', 'gelas', 'cangkir', 'suntik', 'kapas']),
            'details' => $this->faker->sentence(5)
        ];
    }
}
