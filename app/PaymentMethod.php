<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
	protected $fillable = ['name'];
	public $timestamps = false;

	public function shoppingCarts()
	{
		return $this->hasMany('App\ShoppingCart');
	}
}
