<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->articleService->getAll(), 200);
    }

    public function show(int $id): JsonResponse
    {
        $article = $this->articleService->getById($id);
        return $article
            ? response()->json($article, 200)
            : response()->json(['message' => 'article not found'], 404);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string|min:10|max:10000',
            'image'     => 'nullable|string',
            'place_id'  => 'required|exists:places,id'
        ]);


        $article = $this->articleService->create($validated);
        return response()->json($article, 201);
    }



    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string|min:10|max:10000',
            'image'     => 'nullable|string',
            'place_id'  => 'required|exists:places,id'
        ]);

        $article = $this->articleService->update($id, $validated);
        return $article
            ? response()->json($article, 200)
            : response()->json(['message' => 'Place not found'], 404);
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->articleService->delete($id)
            ? response()->json(['message' => 'Article deleted'], 200)
            : response()->json(['message' => 'Article not found'], 404);
    }
}
