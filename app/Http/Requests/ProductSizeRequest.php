<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeRequest extends FormRequest
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
			'ProductSize.priority'  => 'integer|min:0',
			'ProductSize.published' => 'boolean',
			'ProductSize.ProductSizeTranslation.*.name' => 'required|max:250',
		];
	}
}
