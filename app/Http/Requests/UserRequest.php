<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			case 'users.update':
				return [
					'User.last_name' => 'required',
					'User.first_name' => 'required',
					'User.birthday' => 'date_format:"d/m/Y"',
					'User.email' => 'required|email|unique:users,email,' . $this->input('User.id'),
					'User.mobile_phone' => 'max:20',
				];
				break;
			case 'users.store':
				return [
					'User.last_name' => 'required',
					'User.first_name' => 'required',
					'User.birthday' => 'date_format:"d/m/Y"',
					'User.email' => 'required|email|unique:users,email,' . $this->user()->id,
					'User.mobile_phone' => 'max:20',
				];
				break;
			case 'users.passwordchange':
				return  [
					'User.currentpassword'  =>'required|hash:' . $this->user()->password,
					'User.password'  =>'required|different:User.currentpassword|min:6|max:60|confirmed',
					'User.password_confirmation'=>'required|max:60'
				];
				break;
			default:
				return [];
				break;
		}
	}
}
