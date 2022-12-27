<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpec;
use App\Models\Spec;
use ErrorException;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $products = Product::factory(50)->create();
        $specs = Spec::all();
        $specs = $specs->count() > 10 ? $specs : Spec::factory(30)->create();

        $images = [
            'https://www.galerimedika.com/image/catalog/pavblog/img/alkes-stetoskop.jpg',
            'https://media.suara.com/pictures/970x544/2018/03/19/25555-90-persen-alat-kesehatan-di-indonesia-masih-impor.jpg',
            'https://sentralalkes.com/wp-content/uploads/2020/07/tensimeter-min.jpg',
            'https://www.galerimedika.com/image/catalog/pavblog/img/alkes-alat-cek-darah.jpg',
            'https://cdn-asset.jawapos.com/wp-content/uploads/2019/01/industri-alkes-keluhkan-rendahnya-penawaran-pemerintah-dalam-e-katalog_m_210242-560x352.jpeg',
            'https://www.galerimedika.com/image/catalog/pavblog/img/alkes-oximeter.jpg',
            'https://kabarjombang.com/wp-content/uploads/2019/09/ilsutrasi-alkes-dan-obat-obatan-copy.jpg',
            'https://mediaini.com/wp-content/uploads/2021/05/5-alkes-digital-wajib-punya-by-Pixabay.jpg'
        ];

        foreach ($products as $product) {

            //Images
            $imageLen = $faker->numberBetween(0, count($images));
            for ($i = 0; $i <= $imageLen; $i++) {
                $img = $faker->randomElement($images);

                try {
                    $contents = file_get_contents($img);
                    $size = getimagesize($img);
                    $ext = image_type_to_extension($size[2]);
                    $filename = uniqid() . $ext;
                    $path = 'upload/images/product/' . $filename;

                    Storage::disk('local')->put($path, $contents);
                    ProductImage::create([
                        'path' => $path,
                        'filename' => explode('.', $filename)[0],
                        'ext' => ltrim($ext),
                        'product_id' => $product->id
                    ]);
                } catch (ErrorException $e) {
                    dump('Failed to get image, skip');
                }
            }

            //Specs
            $specLen = $faker->numberBetween(0, $specs->count() - 10);
            $cpSpecs = clone $specs;
            for ($i = 0; $i <= $specLen; $i++) {
                $spec = $cpSpecs->random();
                $key = $cpSpecs->search(function ($item) use ($spec) {
                    return $item->id === $spec->id;
                });
                $cpSpecs->forget($key);

                ProductSpec::create([
                    'spec_id' => $spec->id,
                    'product_id' => $product->id,
                    'value' => substr($faker->sentence($faker->randomDigitNot(0)), 0, -1)
                ]);
            }
        }
    }
}
