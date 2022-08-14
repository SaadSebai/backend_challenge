<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\Imageable;

/**
 * @method string store(string|\Illuminate\Http\UploadedFile $image)
 */
class ProductService
{
    use Imageable;

    /**
     * @var ProductRepository
     */
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
        $data['image'] = self::store($data['image']);

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
