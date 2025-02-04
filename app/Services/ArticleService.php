<?php

namespace App\Services;

use App\DataAccess\ArticleDataAccess;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Article;

class ArticleService 
{
    protected $articleDataAccess;

    public function __construct(ArticleDataAccess $articleDataAccess)
    {
        $this->articleDataAccess = $articleDataAccess;
    }

    public function getAll(): Collection
    {
        return $this->articleDataAccess->getAll();
    }

    public function getById(int $id): ?Article
    {
        return $this->articleDataAccess->getById($id);
    }

    public function create(array $data): Article
    {
        return $this->articleDataAccess->create($data);
    }

    public function update(int $id, array $data): ?Article
    {
        return $this->articleDataAccess->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->articleDataAccess->delete($id);
    }
}
