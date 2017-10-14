<?php

namespace App;

class ShoppingCart extends BaseModel
{
	protected $appends = ['total_payment_amount'];

	public function cartDetails()
	{
		return $this->hasMany('App\ShoppingCartDetail');
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

	public function getTotalAmount(){
		$amount = 0;
		foreach ($this->cartDetails as $key => $value) {
			$amount += ($value->product_price * $value->quantity);
		}
		return $amount;
	}

	public function getTotalPromotionAmount(){
		$amount = 0;
		// không tồn tại 2 loại mã thưởng (tiền và %) trên một đơn hàng
		foreach ($this->promotionCodes() as $item) {
			if ($item->value_type) {	// percent
				// chỉ áp dụng một mã thưởng %
				$amount +=  $this->getTotalAmount() * ($item->percent_value / 100);
			}
			else {
				// có thể áp dụng nhiều mã thưởng tiền mặt
				$amount += $item->cash_value;
			}
		}
		return $amount;
	}

	public function getTotalPaymentAmount()
	{
		return $this->getTotalAmount() + $this->shipping_fee - $this->getTotalPromotionAmount();
	}

	public function getTotalPaymentAmountAttribute()
	{
		return $this->attributes['total_payment_amount'] = $this->getTotalPaymentAmount();
	}
}
