<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    public function test_it_returns_a_collection_of_products()
    {
        $product = Product::factory()->create();
        $response = $this->get('/api/products');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $product->id,
            ]);
    }

    public function test_it_returns_a_paginated_data()
    {
        $this->get('/api/products')
            ->assertStatus(200)
            ->assertJsonStructure([
                'links',
                'data',
                'meta'
            ]);
    }
}
