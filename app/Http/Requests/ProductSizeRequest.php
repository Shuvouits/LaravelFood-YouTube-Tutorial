<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeRequest extends FormRequest
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


            'product_id'     => ['required', 'integer', 'exists:products,id'],
            'product_size'   => ['nullable', 'array'],
            'product_size.*' => ['nullable', 'string'],
            'product_price'   => ['nullable', 'array'],
            'product_price.*' => ['nullable', 'numeric'],

        ];
    }
}
