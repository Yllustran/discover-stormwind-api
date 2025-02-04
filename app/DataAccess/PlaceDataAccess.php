<?php

namespace App\DataAccess;

use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

class PlaceDataAccess 
{
    public function getAll(): Collection
    {
        return Place::all();
    }

    public function getById(int $id): ?Place
    {
        return Place::find($id);
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
        $place = Place::find($id);
        return $place ? $place->delete() : false;
    }
}
