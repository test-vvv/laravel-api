<?php

use Illuminate\Database\Seeder;
use App\OrderDraftItems;
use Faker\Factory;

class OrderDraftItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDraftItems::query()->delete();

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            OrderDraftItems::create([
                'order_draft_id' => $faker->numberBetween(1, 10),
                'product_id'     => $faker->numberBetween(1, 10),
                'qty'            => $faker->numberBetween(1, 100)
            ]);
        }    }
}
