<?php

namespace App\Services;

use App\DataAccess\PlaceDataAccess;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Place;

class PlaceService 
{
    protected $placeDataAccess;

    public function __construct(PlaceDataAccess $placeDataAccess)
    {
        $this->placeDataAccess = $placeDataAccess;
    }

    public function getAll(): Collection
    {
        return $this->placeDataAccess->getAll();
    }

    public function getById(int $id): ?Place
    {
        return $this->placeDataAccess->getById($id);
    }

    public function create(array $data): Place
    {
        return Place::create($data);
    }
    

    public function update(int $id, array $data): ?Place
    {
        $place = Place::find($id);
        if ($place) {
            $place->update($data);
        }
        return $place;
    }

    public function delete(int $id): bool
    {
        return $this->placeDataAccess->delete($id);
    }

    public function getByCategory(int $category_id): array
    {
        return $this->placeDataAccess->getByCategory($category_id);
    }
    
}
