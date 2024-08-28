<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory(array $data)
    {
        $filename = '';
        if (isset($data['img']) && $data['img']->isValid()) {
            $filename = time() . '.' . $data['img']->extension();
            $data['img']->move(public_path('/assets/upload/category/'), $filename);
            $data['img'] = '/assets/upload/category/' . $filename;
        }
        return Category::create($data);
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(Category $category, array $data)
    {
        if (isset($data['img']) && $data['img']->isValid()) {
            $this->deleteImage($category->img);
            $filename = time() . '.' . $data['img']->extension();
            $data['img']->move(public_path('/assets/upload/category/'), $filename);
            $data['img'] = '/assets/upload/category/' . $filename;
        }
        $category->update($data);

        return $category;
    }

    public function deleteCategory(Category $category)
    {
        $this->deleteImage($category->img);
        return $category->delete();
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
