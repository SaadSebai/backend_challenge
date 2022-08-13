<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => \Str::title(fake()->word()),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(max: 10000),
            'image' => fake()->image(dir: 'public/storage/images',width: 300, height: 300, fullPath: false)
        ];
    }
}
