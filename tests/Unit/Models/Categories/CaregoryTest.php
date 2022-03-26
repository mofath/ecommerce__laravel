<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class CaregoryTest extends TestCase
{

    public function test_it_has_children()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    public function test_it_can_fetch_only_parents()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_is_orderable_by_a_number_order()
    {
        $category1 = Category::factory()->create([
            'order' => 2
        ]);
        $category2 = Category::factory()->create([
            'order' => 1
        ]);

        $this->assertEquals($category2->name, Category::ordered()->first()->name);
    }

    public function test_it_many_products()
    {
        $category = Category::factory()->create();
        $category->products()->save(
            Product::factory()->create()
        );

        $this->assertInstanceOf(Product::class, $category->products->first());
    }
}
