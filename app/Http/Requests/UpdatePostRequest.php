<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    // Allow request
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules
    public function rules(): array
    {
        return [
            // Title required, min 3 chars, unique except current post
            'title' => 'required|min:3|unique:posts,title,' . $this->route('post'),

            // Description required, min 10 chars
            'desc' => 'required|min:10',

            // Image optional and must be a valid image file
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}