<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brands = Brand::all();
        $brand = $this->faker->randomElement($brands);
        $productName = $this->faker->sentence(3) . " " . $brand->name;
        $words = explode(" ", $productName);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }
        $productCode = strtoupper($acronym) . $this->faker->randomNumber();
        $latestProduct = Product::latest()->first();
        $lastProductId = !$latestProduct ? 0 : $latestProduct->id;
        $suppliers = Supplier::all();
        $supplier = $this->faker->randomElement($suppliers);
        $warehouses = Warehouse::all();
        $warehouse = $this->faker->randomElement($warehouses);
        $units = Unit::all();
        $unit = $this->faker->randomElement($units);
        $categories = Category::all();
        $category = $this->faker->randomElement($categories);
        $sub_categories = SubCategory::all();
        $sub_category = $this->faker->randomElement($sub_categories);

        return [
            'product_code' => $productCode,
            'serial_number' => $lastProductId + 1,
            'product_name' => $productName,
            'qty' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomDigit(6),
            'brand_id' => $brand->id,
            'supplier_id' => $supplier->id,
            'warehouse_id' => $warehouse->id,
            'unit_id' => $unit->id,
            'category_id' => $category->id,
            'sub_category_id' => $sub_category->id
        ];
    }
}
