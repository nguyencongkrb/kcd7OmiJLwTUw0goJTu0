<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCodeRequest extends FormRequest
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

		switch($this->route()->getName())
		{
			case 'promotioncodes.imports':
				return [
					'PromotionCode.import_file' => 'required|file|mimes:xlsx,xls,csv'
				];
				break;
			default:
				return [
					'PromotionCode.code'  => 'required|max:10',
					'PromotionCode.value_type'  => 'boolean',
					'PromotionCode.cash_value'  => 'integer|min:0',
					'PromotionCode.percent_value'  => 'integer|min:0|max:100',
					'PromotionCode.effective_date' => 'required|date|date_format:"Y-m-d"',
					//'PromotionCode.expiry_date' => 'required|date|after:effective_date|date_format:"Y-m-d"',
					'PromotionCode.expiry_date' => 'required|date|date_format:"Y-m-d"',
				];
				break;
		}
	}
}
