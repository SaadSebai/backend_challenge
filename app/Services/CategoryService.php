<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository;
    }

    /**
     * Get a paginated list of products
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get a Category by Id
     *
     * @param  int $id
     *
     * @return Category|null
     */
    public function getById(int $id): Category|null
    {
        return $this->categoryRepository->getById($id);
    }

    /**
     * Create new Category
     *
     * @param  string $name
     * @param  integer|null $parent_id
     *
     * @return Category
     */
    public function create(string $name, ?int $parent_id): Category
    {
        return $this->categoryRepository->create(name: $name, parent_id: $parent_id);
    }

    /**
     * Delete a Category
     *
     * @param  Category $category
     *
     * @return bool
     */
    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
