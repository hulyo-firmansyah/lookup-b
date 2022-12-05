<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Gudang " . $this->faker->city,
            'address' => $this->faker->address,
            'details' => $this->faker->sentence(10)
        ];
    }
}
