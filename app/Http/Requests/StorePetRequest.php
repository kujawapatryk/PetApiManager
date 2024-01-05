<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'id' => 'required|integer',
            'category.id' => 'required|integer',
            'category.name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'photoUrls' => 'array',
            'photoUrls.*' => 'string|max:255',
            'tags' => 'array',
            'tags.*.id' => 'integer',
            'tags.*.name' => 'string|max:255',
            'status' => 'required|string|in:available,pending,sold'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The ID field is required.',
            'id.integer' => 'The ID must be an integer.',
            'category.id.required' => 'The category ID field is required.',
            'category.id.integer' => 'The category ID must be an integer.',
            'category.name.required' => 'The category name field is required.',
            'category.name.string' => 'The category name must be a string.',
            'category.name.max' => 'The category name must not exceed 255 characters.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'photoUrls.required' => 'The photo URLs field is required.',
            'photoUrls.array' => 'The photo URLs must be an array.',
            'photoUrls.*.string' => 'Each photo URL must be a string.',
            'photoUrls.*.max' => 'Each photo URL must not exceed 255 characters.',
            'tags.required' => 'The tags field is required.',
            'tags.array' => 'The tags must be an array.',
            'tags.*.id.integer' => 'Each tag ID must be an integer.',
            'tags.*.name.string' => 'Each tag name must be a string.',
            'tags.*.name.max' => 'Each tag name must not exceed 255 characters.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
            'status.in' => 'The status must be one of the following values: available, pending, sold.'
        ];
    }
}
