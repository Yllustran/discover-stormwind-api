<?php

namespace App\DataAccess;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleDataAccess 
{
    public function getAll(): Collection
    {
        return Article::all();
    }

    public function getById(int $id): ?Article
    {
        return Article::find($id);
    }

    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function update(int $id, array $data): ?Article
    {
        $article = Article::find($id);
        if ($article) {
            $article->update($data);
        }
        return $article;
    }

    public function delete(int $id): bool
    {
        $article = Article::find($id);
        return $article ? $article->delete() : false;
    }
}
