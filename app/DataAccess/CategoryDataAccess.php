<?php

namespace App\DataAccess;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryDataAccess 
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): ?Category
    {
        $category = Category::find($id);
        if ($category) {
            $category->update($data);
        }
        return $category;
    }

    public function delete(int $id): bool
    {
        $category = Category::find($id);
        return $category ? $category->delete() : false;
    }
}
