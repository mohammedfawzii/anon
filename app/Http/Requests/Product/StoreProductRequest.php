<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:10|max:255',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'kind' => 'nullabl',
            'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'colors.*.color_id' => 'required|exists:colors,id',
            'colors.*.sizes.*.size_id' => 'required|exists:sizes,id',
            'colors.*.sizes.*.stock' => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Please select a category. This field is required.',
            'category_id.exists' => 'The selected category does not exist. Please choose a valid category.',

            'name.required' => 'The product name is required. Please enter the name.',
            'name.string' => 'The product name must be a string.',
            'name.min' => 'The product name must be at least 3 characters long.',
            'name.max' => 'The product name must not exceed 255 characters.',

            'description.string' => 'The description must be a string.',
            'description.min' => 'The description must be at least 10 characters long.',
            'description.max' => 'The description must not exceed 255 characters.',

            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 1.',

            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 0.',

            'img.image' => 'The file must be an image.',
            'img.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'img.max' => 'The image size must not exceed 2048 kilobytes.',

            'colors.*.color_id.required' => 'Please select a color for each item.',
            'colors.*.color_id.exists' => 'The selected color does not exist in the records.',
            'colors.*.stock.required' => 'Please specify the stock for each color.',
            'colors.*.stock.integer' => 'The stock for each color must be an integer.',
            'colors.*.stock.min' => 'The stock for each color must be at least 0.',

            'sizes.*.size_id.required' => 'Please select a color for each item.',
            'sizes.*.size_id.exists' => 'The selected color does not exist in the records.',
            'sizes.*.stock.required' => 'Please specify the stock for each color.',
            'sizes.*.stock.integer' => 'The stock for each color must be an integer.',
            'sizes.*.stock.min' => 'The stock for each color must be at least 0.',
        ];
    }
}
