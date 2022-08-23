<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Get a paginated list of products
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
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
        return Category::find($id);
    }

    /**
     * Create new Category
     *
     * @param  string $name
     * @param  int|null $parent_id
     *
     * @return Category
     */
    public function create(string $name, ?int $parent_id): Category
    {
        return Category::create([
            'name'      => $name,
            'parent_id' => $parent_id
        ]);
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
