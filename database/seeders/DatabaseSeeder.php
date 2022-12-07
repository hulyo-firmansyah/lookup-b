<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Warehouse;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Brand::factory(10)->create();
        Supplier::factory(10)->create();
        Warehouse::factory(10)->create();
        Category::factory(10)->create();
        SubCategory::factory(10)->create();
        Unit::factory(10)->create();
        Product::factory(100)->create();
    }
}
