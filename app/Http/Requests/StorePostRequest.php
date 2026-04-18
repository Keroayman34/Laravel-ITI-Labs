<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    // Allow request to pass
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules
    public function rules(): array
    {
        return [
            // Title is required, min 3 chars, and must be unique
            'title' => 'required|min:3|unique:posts,title',

            // Description is required and at least 10 chars
            'desc' => 'required|min:10',

            // Image is required and must be a valid image file
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}