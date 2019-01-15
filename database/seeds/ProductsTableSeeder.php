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

        for ($i = 0; $i < 10; $i++) {
            Product::firstOrCreate([
                'productType' => $faker->word,
                'color' => $faker->safeColorName,
                'size' => $faker->word,
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 100)
            ]);
        }
    }
}
