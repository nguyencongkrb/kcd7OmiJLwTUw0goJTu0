<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInfo extends Model
{
	public $timestamps = false;

	public function shoppingCart()
	{
		return $this->belongsTo('App\ShoppingCart');
	}
}
