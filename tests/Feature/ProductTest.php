<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProductTest extends TestCase
{
    use WithFaker;

    public function testRequiresAllFields()
    {
        $this->post('api/products')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'color'        => ["Field is required"],
                    'product_type' => ["Field is required"],
                    'size'         => ["Field is required"],
                    'price'        => ["Field is required"],
                ]
            ]);
    }

    public function testRequiresFieldsCombinationUnique()
    {
        $color = $this->faker->safeColorName;
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 10);

        $payload = [
            "color"        => $color,
            "product_type" => "Notebook",
            "size"         => "2",
            "price"        => $price

        ];

        $this->json('POST','api/products', $payload)
            ->assertStatus(201)
            ->assertJson([
                "color"        => $color,
                "product_type" => "Notebook",
                "size"         => "2",
                "price"        => $price

            ]);

        $this->json('POST','api/products', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    "color" => ["Color, size and price fields combination must be unique"]
                ]
            ]);
    }
}
