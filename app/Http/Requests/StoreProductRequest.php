<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'product_code'  => ['required', 'string', 'max:100', 'unique:products,product_code'],
            'category'      => ['required', 'string', 'max:100'],
            'description'   => ['required', 'string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'quantity'      => ['required', 'integer', 'min:0'],
            'status'        => ['required', 'in:active,inactive'],
            'images'        => ['nullable', 'array'],
            'images.*'      => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'Product name is required.',
            'name.max'              => 'Product name may not exceed 255 characters.',
            'product_code.required' => 'Product code is required.',
            'product_code.unique'   => 'This product code is already taken.',
            'category.required'     => 'Category is required.',
            'description.required'  => 'Description is required.',
            'price.required'        => 'Price is required.',
            'price.numeric'         => 'Price must be a valid number.',
            'quantity.required'     => 'Quantity is required.',
            'quantity.integer'      => 'Quantity must be a whole number.',
            'images.*.image'        => 'Each file must be a valid image.',
            'images.*.mimes'        => 'Images must be JPG, JPEG, PNG, or WEBP.',
            'images.*.max'          => 'Each image must not exceed 2 MB.',
        ];
    }
}
