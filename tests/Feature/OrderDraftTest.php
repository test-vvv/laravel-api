<?php

namespace Tests\Feature\Feature;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class OrderDraftTest extends TestCase
{

    public function testReturnAllDrafts()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->get('api/orderDrafts')
            ->assertSuccessful()
            ->assertJsonCount(3, 'data');
    }

    public function testReturnDraftByProductType()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->get('api/orderDrafts/Notebook')
            ->assertSuccessful()
            ->assertJsonCount(1, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        "2" => [
                            [
                                'qty',
                                'product' => [
                                    "id",
                                    "product_type",
                                    "color",
                                    "size",
                                    "price"
                                ]
                            ],
                            [
                                'qty',
                                'product' => [
                                    "id",
                                    "product_type",
                                    "color",
                                    "size",
                                    "price"
                                ]
                            ]
                        ],
                        'draft_order_id',
                        'country_code'
                    ]
                ]
            ]);
    }

    public function testReturnErrorWhenTotalPriceBellowLimit()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $payload = [
            "data" => [
                "products" => [
                    ["product_id" => 1, "qty" => 2],
                    ["product_id" => 2, "qty" => 2]
                ]
            ]
        ];

        $this->json('GET', 'api/orderDraft/calculate', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonFragment([
                "error" => "Total price is too low"
            ]);
    }
    public function testReturnCorrectTotal()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $payload = [
            "data" => [
                "products" => [
                    ["product_id" => 1, "qty" => 20],
                    ["product_id" => 2, "qty" => 2]
                ]
            ]
        ];

        $this->json('GET', 'api/orderDraft/calculate', $payload)
            ->assertSuccessful()
            ->assertJsonFragment([
                "Total price" => 27.28
            ]);
    }

    public function testRequestThrottle()
    {
        // Requests are limited to 1 request/second
        $this->json('GET', 'api/orderDraft/test');
        $this->json('GET', 'api/orderDraft/test')
            ->assertStatus(Response::HTTP_TOO_MANY_REQUESTS);
    }
}
