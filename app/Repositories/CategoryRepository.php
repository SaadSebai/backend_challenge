<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Get a Category by Id
     *
     * @param  int $id
     *
     * @return Category|null
     */
    public function getById(int $id): Category|null
    {
        return Category::find($id);
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
        return Category::create($data);
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
        return $category->delete();
    }
}
