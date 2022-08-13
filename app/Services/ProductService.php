<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = resolve(ProductRepository::class);
    }

    /**
     * Get a Product by Id
     *
     * @param  int $id
     *
     * @return Product|null
     */
    public function getById(int $id): Product|null
    {
        return $this->productRepository->getById($id);
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
        return $this->productRepository->create($data);
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
        return $this->productRepository->delete($product);
    }
}
