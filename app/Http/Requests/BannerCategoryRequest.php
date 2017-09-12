<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerCategoryRequest extends FormRequest
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
			'BannerCategory.priority'  => 'integer|min:0',
			'BannerCategory.published' => 'boolean',
			'BannerCategory.BannerCategoryTranslation.*.name' => 'required|max:250',
		];
	}
}
