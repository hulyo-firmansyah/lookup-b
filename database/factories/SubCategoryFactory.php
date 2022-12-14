<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categories = Category::all();

        return [
            'name' => $this->faker->randomElement(['bed pasien', 'unit alat', 'gelas', 'cangkir', 'suntik', 'kapas']),
            'category_id' => $this->faker->randomElement($categories)->id,
            'details' => $this->faker->sentence(5)
        ];
    }
}
