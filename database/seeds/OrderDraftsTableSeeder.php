<?php

use Illuminate\Database\Seeder;
use App\OrderDraft;
use Faker\Factory;

class OrderDraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDraft::query()->delete();

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            OrderDraft::create([
                'country_code' => $faker->randomElement($array = ['US','DE','GB','AF'])
            ]);
        }    }
}
