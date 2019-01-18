<?php

use Illuminate\Database\Seeder;
use App\OrderDraftItem;
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
        OrderDraftItem::query()->delete();

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            OrderDraftItem::create([
                'order_draft_id' => $faker->numberBetween(1, 10),
                'product_id'     => $faker->numberBetween(1, 10),
                'qty'            => $faker->numberBetween(1, 10)
            ]);
        }    }
}
