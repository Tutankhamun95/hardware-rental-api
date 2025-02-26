<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'region'        => 'sometimes|integer|exists:regions,id',
            'rental_period' => 'sometimes|integer|exists:rental_periods,id',
            'category'      => 'sometimes|integer|exists:categories,id',
            'availability'  => 'sometimes|in:available,out_of_stock',
            'query'         => 'sometimes|string'
        ];
    }
}
