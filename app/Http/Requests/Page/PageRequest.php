<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
		$result = [];

		switch ($this->route()->getName()) {
			case 'search':
				$result = [
					'keyword' => 'required|userinput'
				];
				break;
			case 'user.create':
				$result = [
					//'User.last_name' => 'required',
					'User.first_name' => 'required|userinput',
					'User.birthday' => 'date_format:"d/m/Y"',
					'User.email' => is_null($this->user()) ? 'required|email|unique:users,email' : 'required|email|unique:users,email,' . $this->user()->id,
					'User.mobile_phone' => 'max:20',
					'User.password'  =>'required|min:6|max:60|confirmed',
					'User.password_confirmation'=>'required|max:60'
				];
				break;
			case 'user.updateprofile':
				$result = [
					//'User.last_name' => 'required',
					'User.first_name' => 'required|userinput',
					'User.birthday' => 'date_format:"d/m/Y"',
					'User.email' => is_null($this->user()) ? 'required|email|unique:users,email' : 'required|email|unique:users,email,' . $this->user()->id,
					'User.mobile_phone' => 'max:20',
				];
				break;
			case 'user.updatepassword':
				$result = [
					'User.currentpassword'  =>'required|hash:' . $this->user()->password,
					'User.password'  =>'required|different:User.currentpassword|min:6|max:60|confirmed',
					'User.password_confirmation'=>'required|max:60'
				];
				break;
			case 'purchase':
				$result = [
					'ShoppingCart.customer_name'  => 'required|max:50|userinput',
					'ShoppingCart.customer_email'  => 'required|email|max:50',
					'ShoppingCart.customer_phone'=> 'required|max:20',
					'ShoppingCart.customer_address'=> 'required|max:250|userinput',
					'ShoppingCart.customer_note'=> 'max:300|userinput',
					'ShoppingCart.cartDetails.*.product_id'=> 'required|integer|exists:products,id',
					//'ShoppingCart.cartDetails.*.product_size_id'=> 'required|integer|exists:product_sizes,id',
					'ShoppingCart.cartDetails.*.product_size_id'=> 'integer',
					'ShoppingCart.cartDetails.*.product_color_id'=> 'required|integer|exists:product_colors,id',
					'ShoppingCart.cartDetails.*.quantity'=> 'required|integer|min:1',
				];
				break;
			case 'contact.create':
				$result = [
					'Contact.full_name'  => 'required|max:50|userinput',
					'Contact.email'  =>'required|email|max:50',
					'Contact.phone'=>'required|max:20',
					'Contact.subject'=>'required|max:240|userinput',
					'Contact.content'=>'required|max:500|userinput',
				];
				break;
			default:
				# code...
				break;
		}

		return $result;
	}
}
