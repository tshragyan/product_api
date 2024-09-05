<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'options' => 'nullable|array',
            'options.*.title' => 'required|string',
            'options.*.value' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be string.',
            'name.unique' => 'The product name must be unique.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The price must be a number.',
            'options.array' => 'The options must be an array.',
            'options.*.title.required' => 'The options title is required.',
            'options.*.value.required' => 'The options value is required.',
            'options.*.title.string' => 'The options title must be a string.',
            'options.*.value.string' => 'The options value must be a string.',
        ];
    }
}
