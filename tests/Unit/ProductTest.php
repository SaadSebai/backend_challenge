<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Faker\Generator;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_products_product_creation()
    {
        $category_id = Category::first()?->id;

        $product1 = [
            'name' => 'product1',
            'description' => 'some text',
            'price' => 12.1,
            'category_id' => $category_id,
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post('/api/products', $product1);

        $response->assertStatus(200);

        $product2 = [
            'name' => 'product1',
            'description' => 'some text',
            'price' => 12.1,
            'category_id' => 1,
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ];


        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/products', $product2);

        $response->assertStatus(422);
    }
}
