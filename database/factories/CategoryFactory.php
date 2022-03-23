<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $name = $this->faker->name,
            'slug' => Str::slug($name, '-'),
        ];
    }
}
