<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Spec;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = Product::all();
        $specs = Spec::all();

        return [
            'spec_id' => $this->faker->randomElement($specs)->id,
            'product_id' => $this->faker->randomElement($products)->id,
            'value' => $this->faker->sentence(3)
        ];
    }
}
