<?php

namespace App;

class ShoppingCart extends BaseModel
{
	public function cartDetails()
	{
		return $this->hasMany('App\ShoppingCartDetail');
	}

	public function getTotalAmount(){
		$amount = 0;

		foreach ($this->cartDetails as $key => $value) {
			$amount += ($value->product_price * $value->quantity);
		}
		return $amount;
	}

	public function status()
	{
		return $this->belongsTo('App\ShoppingCartStatus');
	}

	public function paymentMethod()
	{
		return $this->belongsTo('App\PaymentMethod');
	}

	public function invoiceInfo()
	{
		return $this->hasOne('App\InvoiceInfo');
	}
}
