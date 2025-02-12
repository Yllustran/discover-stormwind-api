<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'latitude'    => 'required|numeric|max:5000',
            'longitude'   => 'required|numeric|max:5000',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        // image upload 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('places', 'public');
            $validated['image'] = $imagePath;
        }
    
        $place = $this->placeService->create($validated);
        return response()->json($place, 201);
    }
    

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'latitude'    => 'required|numeric|max:5000',
            'longitude'   => 'required|numeric|max:5000',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        // image upload 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('places', 'public');
            $validated['image'] = $imagePath;
        }
    
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

    public function getByCategory(int $category_id): JsonResponse
    {
        $places = $this->placeService->getByCategory($category_id);
    
        return count($places) > 0
            ? response()->json($places, 200)
            : response()->json(['message' => 'No places found for this category'], 404);
    }
    
}
