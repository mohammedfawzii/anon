<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
            'img' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function message(): array
    {
        return [
            'name.required' => 'Please enter a branch name.',
            'name.string' => 'Branch name must be a string.',
            'name.max' => 'Branch name must be less than 255 characters.',
            'img.mimes' => 'Please select a valid image file (JPEG, PNG, JPG, GIF).',
            'img.max' => 'The image file size must not exceed 2MB.'
        ];
    }
}
