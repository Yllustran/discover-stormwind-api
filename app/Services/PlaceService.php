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
        return $this->placeDataAccess->create($data);
    }

    public function update(int $id, array $data): ?Place
    {
        return $this->placeDataAccess->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->placeDataAccess->delete($id);
    }
}
