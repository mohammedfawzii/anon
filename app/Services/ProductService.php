<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAllProduct()
    {
        return Product::all();
    }

    public function createProduct(array $data): Product
    {
        $product = Product::create($data);
        $totalStock = 0;
        if (isset($data['img']) && is_array($data['img'])) {
            foreach ($data['img'] as $image) {
                if ($image->isValid()) {
                    $filename = time() . '-' . uniqid() . '.' . $image->extension();
                    $image->move(public_path('/assets/upload/product/'), $filename);
                    $product->images()->create([
                        'image_path' => '/assets/upload/product/' . $filename,
                    ]);
                }
            }
        }
        if (isset($data['colors'])) {
            foreach ($data['colors'] as $color) {
                foreach ($color['sizes'] as $size) {
                    $product->colors()->attach($color['color_id'], [
                        'size_id' => $size['size_id'],
                        'stock' => $size['stock'],
                    ]);
                    $totalStock += $size['stock'];
                }
            }
        }
        $product->update(['stock' => $totalStock]);
        return $product;
    }



    public function updateProduct(Product $product, array $data): Product
    {
        if (isset($data['img']) && $data['img']->isValid()) {
            if ($product->img && Storage::exists($product->img)) {
                Storage::delete($product->img);
            }
            $filename = time() . '.' . $data['img']->extension();
            $data['img']->move(public_path('/assets/upload/product/'), $filename);
            $data['img'] = '/assets/upload/product/' . $filename;
        } else {
            unset($data['img']);
        }
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product): void
    {
        if ($product->img && Storage::exists($product->img)) {
            Storage::delete($product->img);
        }

        $product->delete();
    }

    public function decrementStock(Product $product, int $quantity): bool
    {
        if ($product->stock < $quantity) {
            return false;
        }

        $product->decrement('stock', $quantity);
        return true;
    }

    public function updateProductRating(Product $product, int $rating): void
    {
        $product->update(['stars' => $rating]);
    }
}
