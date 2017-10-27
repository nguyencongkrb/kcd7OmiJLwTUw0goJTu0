<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
			'Product.code'  => 'unique:products,code,' . $this->route()->getParameter('product', 0) . '|max:20',
			'Product.model'  => 'max:100',
			'Product.custom_size'  => 'max:100',
			'Product.origin'  => 'max:100',
			'Product.unit'  => 'max:100',
			'Product.price'  => 'integer|min:0',
			'Product.sale_price'  => 'integer|min:0',
			'Product.sale_ratio'  => 'integer|min:0|max:100',
			'Product.warranty'  => 'max:100',
			'Product.priority'  => 'integer|min:0',
			'Product.inventory_quantity'  => 'integer|min:0',
			'Product.instock_date' => 'date_format:"Y-m-d"',
			'Product.published' => 'boolean',
			'Product.availability' => 'in:instock,outofstock,preorder,availablefororder',
			'Product.ProductTranslation.*.name' => 'required|max:250',
		];
	}
}
