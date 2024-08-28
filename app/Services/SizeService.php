<?php

namespace App\Services;


use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;

class SizeService
{
    public function getAllSizes(): Collection
    {
        return Size::all();
    }


    public function createSize(array $data): Size
    {

        return Size::create($data);
    }

    public function getSizeById(int $id): Size
    {
        return Size::findOrFail($id);
    }


    public function updateSize(Size $Size, array $data): Size
    {

        $Size->update($data);

        return $Size;
    }


    public function deleteSize(Size $Size): ?bool
    {
        return $Size->delete();
    }
}
