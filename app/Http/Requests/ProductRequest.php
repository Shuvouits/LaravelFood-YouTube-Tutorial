<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $productId = $this->route('product');
        if (is_object($productId)) {
            $productId = $productId->id;
        }

        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'product_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$productId,
            'product_category' => 'required',
            'price' => 'nullable|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string|max:1000',
            'long_description' => 'nullable|string',
            'today_special' => 'required|in:yes,no',
            'status' => 'required|in:active,inactive',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:1000',
        ];

    }
}
