<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = ['PT IHS', 'PT DCA', 'PT Kreasi Sukses Indoprima', 'PT Mitra Tsalasa Jaya', 'PT Satria Saftindo Jaya', 'PT Siantar Usaha Bersama', 'PT Sumber Utama Medicalindo'];

        foreach ($suppliers as $sup) {
            Supplier::create([
                'name' => $sup,
                'phone' => '6285755799604',
                'address' => 'Malang'
            ]);
        }
    }
}
