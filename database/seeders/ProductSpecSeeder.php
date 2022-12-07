<?php

namespace Database\Seeders;

use App\Models\ProductSpec;
use Illuminate\Database\Seeder;

class ProductSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSpec::factory(100)->create();
    }
}
