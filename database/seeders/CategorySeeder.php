<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Medical Equipment',
                'sub' => [
                    ['name' => 'Bad Table'],
                    ['name' => 'Socks'],
                    ['name' => 'Scale'],
                    ['name' => 'Wheelchair']
                ]
            ], [
                'name' => 'Used Medical Equipment',
                'sub' => [
                    ['name' => 'Bed Pasien 2 Crank'],
                    ['name' => 'Patient Monitor'],
                    ['name' => 'Scale']
                ]
            ],
            [
                'name' => 'Bahan Habis Pakai', 'sub' => [
                    ['name' => 'Deck Glass'],
                    ['name' => 'Socks'],
                    ['name' => 'Corset'],
                    ['name' => 'Alcohol'],
                    ['name' => 'Alcohol Swab'],
                    ['name' => 'Arm Sling'],
                ]
            ],
            [
                'name' => 'Lab', 'sub' => [
                    ['name' => 'Tools'],
                    ['name' => 'Material'],
                ]
            ],
            [
                'name' => 'Sparepart Alkes', 'sub' => [
                    ['name' => 'Wheel'],
                ]
            ]
        ];

        foreach ($categories as $category) {
            $ctg = Category::create([
                'name' => $category['name']
            ]);

            foreach ($category['sub'] as $sub) {
                SubCategory::create([
                    'name' => $sub['name'],
                    'category_id' => $ctg->id
                ]);
            }
        }
    }
}
