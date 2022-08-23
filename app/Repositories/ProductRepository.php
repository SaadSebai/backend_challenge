<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    /**
     * Get a paginated list of products
     *
     * @param array $data filters, sort field and sort order
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $data = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Product::with('category')
                ->when($data['filters'] ?? false, function ($query, $filters) {

                    $query->when(array_key_exists('category_id', $filters),
                        fn($query) => $query->whereCategoryId($filters['category_id'])
                    );

                })
                ->orderBy($data['sortField'] ?? 'name', $data['sortOrder'] ?? 'asc')
                ->paginate();
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
        return Product::find($id);
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
        return Product::create([
            'name'          => $name,
            'description'   => $description,
            'price'         => $price,
            'image'         => $image,
            'category_id'   => $category_id
        ]);
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
