<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionCode extends BaseModel
{
	use SoftDeletes;
	protected $fillable = ['code', 'value_type', 'cash_value', 'percent_value', 'effective_date', 'expiry_date', 'created_by'];

	public function shoppingcart()
	{
		return $this->belongsTo('App\ShoppingCart');
	}
}
