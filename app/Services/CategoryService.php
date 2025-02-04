<?php

namespace App\Services;

use App\DataAccess\CategoryDataAccess;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryService 
{
    protected $categoryDataAccess;

    public function __construct(CategoryDataAccess $categoryDataAccess)
    {
        $this->categoryDataAccess = $categoryDataAccess;
    }

    public function getAll(): Collection
    {
        return $this->categoryDataAccess->getAll();
    }

    public function getById(int $id): ?Category
    {
        return $this->categoryDataAccess->getById($id);
    }

    public function create(array $data): Category
    {
        return $this->categoryDataAccess->create($data);
    }

    public function update(int $id, array $data): ?Category
    {
        return $this->categoryDataAccess->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->categoryDataAccess->delete($id);
    }
}
