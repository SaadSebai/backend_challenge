<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    /**
     * Get a Product by Id
     *
     * @param  int $id
     *
     * @return Product|null
     */
    public function getById(int $id): Product|null
    {
        return Product::find($id);
    }

    /**
     * Create new Product
     *
     * @param  array $data
     *
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Delete a Product
     *
     * @param  Product $product
     *
     * @return bool
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
