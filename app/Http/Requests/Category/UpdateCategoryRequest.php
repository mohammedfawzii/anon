<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => 'exists:branches,id',
            'name' => 'required|string|max:255',
            'img' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the product name.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name cannot exceed 255 characters.',
            'img.image' => 'The :attribute must be an image.',
            'img.mimes' => 'The :attribute must be a file of type: jpeg, png, jpg, gif.',
            'img.max' => 'The :attribute size must not exceed 2 MB.',
        ];

    }
}
