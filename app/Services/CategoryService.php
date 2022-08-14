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
        $this->categoryRepository = resolve(CategoryRepository::class);
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
     * @param  array $data
     *
     * @return Category
     */
    public function create(array $data): Category
    {
        return $this->categoryRepository->create($data);
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
