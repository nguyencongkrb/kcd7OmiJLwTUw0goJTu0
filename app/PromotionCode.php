<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionCode extends BaseModel
{
	use SoftDeletes;
	protected $fillable = ['code', 'value_type', 'cash_value', 'percent_value', 'effective_date', 'expiry_date', 'created_by'];

	public function shoppingCarts()
	{
		return $this->belongsToMany('App\ShoppingCart', 'prommotion_code_shopping_cart');
	}
}
