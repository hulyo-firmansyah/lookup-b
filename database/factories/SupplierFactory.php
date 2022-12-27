<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Supplier Kota ' . $this->faker->city,
            'phone' => "+6285755799604",
            'email' => $this->faker->unique()->email,
            'address' => $this->faker->address,
            'details' => $this->faker->paragraph(2)
        ];
    }
}
