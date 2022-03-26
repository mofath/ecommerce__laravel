<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    public function test_it_returns_a_collection_of_categories()
    {
        $categories = Category::factory()->count(2)->create();
        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'slug' => $category->slug
            ]);
        });
    }

    public function test_it_returns_only_parent_categories()
    {
        $category = Category::factory()->create();
        $category->children()->save(
            Category::factory()->create()
        );

        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_it_returns_categories_ordered_by_their_given_order()
    {
        $categories = Category::factory()
            ->count(2)
            ->state(new Sequence(
                ['order' => 2],
                ['order' => 1],
            ))
            ->create();

        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertSeeinOrder([
            $categories->last()->slug, $categories->first()->slug
        ]);
    }
}
