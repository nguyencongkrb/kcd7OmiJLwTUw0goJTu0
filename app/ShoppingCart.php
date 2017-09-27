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
		return $this->belongsTo('App\ShoppingCartStatus', 'shopping_cart_status_id');
	}

	public function paymentMethod()
	{
		return $this->belongsTo('App\PaymentMethod');
	}

	public function invoiceInfo()
	{
		return $this->hasOne('App\InvoiceInfo');
	}

	public function promotionCodes()
	{
		return $this->belongsToMany('App\PromotionCode', 'prommotion_code_shopping_cart');
	}

	public function customerProvince()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }

	public function customerDistrict()
	{
		return $this->belongsTo('App\District', 'district_id');
	}

	public function shippingProvince()
	{
		return $this->belongsTo('App\Province', 'shipping_province_id');
	}

	public function shippingDistrict()
	{
		return $this->belongsTo('App\District', 'shipping_district_id');
	}
}
