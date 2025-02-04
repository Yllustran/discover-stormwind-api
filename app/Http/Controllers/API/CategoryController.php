<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // Request for render all categories
    public function index(): JsonResponse
    {
        return response()->json($this->categoryService->getAll(), 200);
    }

    // Request for render a category by ID 
    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->getById($id);
        return $category 
            ? response()->json($category, 200) 
            : response()->json(['message' => 'Category not found'], 404);
    }

    // Request for create a new category
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = $this->categoryService->create($validated);
        return response()->json($category, 201);
    }

    // Request for update a category by ID
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = $this->categoryService->update($id, $validated);
        return $category
            ? response()->json($category, 200)
            : response()->json(['message' => 'Category not found'], 404);
    }

    // Request for delete a category by ID
    public function destroy(int $id): JsonResponse
    {
        return $this->categoryService->delete($id)
            ? response()->json(['message' => 'Category deleted'], 200)
            : response()->json(['message' => 'Category not found'], 404);
    }
}
