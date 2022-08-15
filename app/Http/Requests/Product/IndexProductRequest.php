<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'filters'               => ['nullable', 'array'],
            'filters.category_id'   => ['nullable', 'bail', 'integer', 'exists:products,id'],
            'sortField'             => ['nullable', 'string', Rule::in(Product::SORT_FIELDS)],
            'sortOrder'             => ['nullable', 'string', 'in:asc,desc']
        ];
    }
}
