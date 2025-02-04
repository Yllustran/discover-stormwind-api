<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->placeService->getAll(), 200);
    }

    public function show(int $id): JsonResponse
    {
        $place = $this->placeService->getById($id);
        return $place 
            ? response()->json($place, 200) 
            : response()->json(['message' => 'Place not found'], 404);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $place = $this->placeService->create($validated);
        return response()->json($place, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $place = $this->placeService->update($id, $validated);
        return $place
            ? response()->json($place, 200)
            : response()->json(['message' => 'Place not found'], 404);
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->placeService->delete($id)
            ? response()->json(['message' => 'Place deleted'], 200)
            : response()->json(['message' => 'Place not found'], 404);
    }
}
