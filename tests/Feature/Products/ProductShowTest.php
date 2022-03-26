<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    public function test_it_fails_if_a_product_cant_be_found()
    {
        $this
            ->get('/api/products/doesnt-exist')
            ->assertStatus(404);
    }

    public function test_it_shows_a_product()
    {
        $product = Product::factory()->create();

        $this
            ->get("/api/products/{$product->slug}")
            ->assertStatus(200)
            ->assertJsonFragment([
                'slug' => $product->slug
            ]);
    }
}
