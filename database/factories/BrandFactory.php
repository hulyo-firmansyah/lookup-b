<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['gea', 'onemed', 'terumo', 'abn']),
            'details' => $this->faker->sentence(3)
        ];
    }
}
