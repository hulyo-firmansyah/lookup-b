<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'spec' => $this->faker->sentence(1),
            'details' => $this->faker->sentence(3)
        ];
    }
}
