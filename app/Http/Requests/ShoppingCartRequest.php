<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartRequest extends FormRequest
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
			'ShoppingCart.shopping_cart_status_id'  => 'integer|exists:shopping_cart_statuses,id',
			'ShoppingCart.invoice_exported' => 'boolean',
			'ShoppingCart.payment_status' => 'boolean',
		];
	}
}
