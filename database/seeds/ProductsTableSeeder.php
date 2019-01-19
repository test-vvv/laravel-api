<?php

use Illuminate\Database\Seeder;
use App\Product;
use Faker\Factory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->delete();

        $faker = Factory::create();

        Product::create([
            'product_type' => 'Tablet',
            'color'        => $faker->safeColorName,
            'size'         => $faker->word,
            'price'        => 1.11
        ]);

        Product::create([
            'product_type' => 'Notebook',
            'color'        => $faker->safeColorName,
            'size'         => $faker->word,
            'price'        => 2.54
        ]);

        Product::create([
            'product_type' => 'Notebook',
            'color'        => $faker->safeColorName,
            'size'         => $faker->word,
            'price'        => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 10)
        ]);

        Product::create([
            'product_type' => 'Desktop',
            'color'        => $faker->safeColorName,
            'size'         => $faker->word,
            'price'        => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 10)
        ]);

        Product::create([
            'product_type' => 'Desktop',
            'color'        => $faker->safeColorName,
            'size'         => $faker->word,
            'price'        => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 10)
        ]);


    }
}
