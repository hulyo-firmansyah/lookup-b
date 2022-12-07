<?php

namespace Database\Seeders;

use App\Models\Spec;
use Illuminate\Database\Seeder;

class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spec::factory(100)->create();
    }
}
