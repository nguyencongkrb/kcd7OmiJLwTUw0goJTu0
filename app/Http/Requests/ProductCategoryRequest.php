<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ProductCategory.priority'  => 'integer|min:0',
            'ProductCategory.published' => 'boolean',
            'ProductCategory.ProductCategoryTranslation.*.name' => 'required|max:250',
        ];
    }
}
