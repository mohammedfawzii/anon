<?php

namespace App\Services;

use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;

class ColorService
{
    /**
     * Get all colors.
     *
     * @return Collection
     */
    public function getAllColors(): Collection
    {
        return Color::all();
    }

    /**
     * Create a new color.
     *
     * @param array $data
     * @return Color
     */
    public function createColor(array $data): Color
    {
        // Validate data if needed

        return Color::create($data);
    }

    /**
     * Get a color by ID.
     *
     * @param int $id
     * @return Color
     */
    public function getColorById(int $id): Color
    {
        return Color::findOrFail($id);
    }

    /**
     * Update an existing color.
     *
     * @param Color $color
     * @param array $data
     * @return Color
     */
    public function updateColor(Color $color, array $data): Color
    {
        // Validate data if needed

        $color->update($data);

        return $color;
    }

    /**
     * Delete a color.
     *
     * @param Color $color
     * @return bool|null
     */
    public function deleteColor(Color $color): ?bool
    {
        return $color->delete();
    }
}
