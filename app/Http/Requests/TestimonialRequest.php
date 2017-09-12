<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
			'Testimonial.priority'  => 'integer|min:0',
			'Testimonial.published' => 'boolean',
			'Testimonial.TestimonialTranslation.*.full_name' => 'required|max:50',
			'Testimonial.TestimonialTranslation.*.content' => 'required|max:250',
		];
	}
}
