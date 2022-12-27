<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = ['kg', 'box', 'pcs', 'unit'];

        foreach ($units as $unit) {
            Unit::create([
                'name' => $unit
            ]);
        }
    }
}
