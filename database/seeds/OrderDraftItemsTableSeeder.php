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

            OrderDraftItem::create([
                'order_draft_id' => 1,
                'product_id'     => 1,
                'qty'            => 1
            ]);

            OrderDraftItem::create([
                'order_draft_id' => 2,
                'product_id'     => 2,
                'qty'            => 5
            ]);

            OrderDraftItem::create([
                'order_draft_id' => 2,
                'product_id'     => 1,
                'qty'            => 1
            ]);

            OrderDraftItem::create([
                'order_draft_id' => 3,
                'product_id'     => 5,
                'qty'            => 6
            ]);
    }

}
