<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\Imageable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
        $this->productRepository = new ProductRepository;
    }

    /**
     * Get a paginated list of products
     *
     * @param array $data filters, sort field and sort order
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $data = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->productRepository->getAll($data);
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
     * @param  string $name
     * @param  string $description
     * @param  float $price
     * @param  string $image
     * @param  integer $category_id
     *
     * @return Product
     */
    public function create(string $name, string $description, float $price, string $image, int $category_id): Product
    {
        $data['image'] = self::store($image);

        return $this->productRepository->create(name: $name, description: $description, price: $price, image: $image, category_id: $category_id);
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
