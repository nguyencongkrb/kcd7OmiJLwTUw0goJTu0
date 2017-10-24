<?php

namespace App;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OrderPurchase;
use App\Mail\OrderCancel;
use App\Mail\OrderDelivered;
use App\Config;
use Log;

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
		foreach ($this->promotionCodes()->get() as $item) {
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

	public function sentSMS()
	{
		$phoneNumber = $this->customer_phone;
		$smsMessage = '';

		$now = Carbon::now();
		$site_name = Config::getValueByKey('site_name');
		$hotline = Config::getValueByKey('hot_line');

		if ($this->shopping_cart_status_id == 1) {	// HUY
			$smsMessage = 'Xin chao ban, Qua tang '.$site_name.' thong bao don hang '.$this->code.' cua ban da duoc huy luc '.$now->format('H:i').'-'.$now->format('d/m/y').'. Vui long lien he Hotline: '.$hotline;
		}
		elseif ($this->shopping_cart_status_id == 2) {	// MOI DAT HANG
			$smsMessage = 'Xin chao ban, Qua tang '.$site_name.' da nhan duoc don hang cua ban luc '.$this->created_at->format('H:i').'-'.$this->created_at->format('d/m/y').', ma so '.$this->code.'. So tien '.number_format($this->getTotalPaymentAmount(), 0, ',', '.').'VNĐ. Hotline: '.$hotline;
		}
		elseif ($this->shopping_cart_status_id == 5) {	// DA GIAO HANG
			$smsMessage = 'Xin chao ban, Qua tang '.$site_name.' thong bao don hang '.$this->code.' cua ban da duoc giao thanh cong ngay '.$now->format('d/m/y').'. Vui long lien he Hotline: '.$hotline;
		}

		if (!empty($phoneNumber) && !empty($smsMessage)) {
			$sms_Url = env('SMS_Url', '');
			$sms_Username = env('SMS_Username', '');
			$sms_Password = env('SMS_Password', '');

			$fullUrl = $sms_Url . '?clientNo='.$sms_Username.'&clientPass='.$sms_Password.'&senderName=Sunmart&phoneNumber='.$phoneNumber.'&smsMessage='.$smsMessage.'&smsGUID=0&serviceType=0'; 

			//return $fullUrl;

			$client = new \GuzzleHttp\Client();
			$res = $client->request('GET', $fullUrl);
			return $res->getStatusCode(); // 200
		}
	}

	public function sentNotify()
	{
		try {
			if ($this->shopping_cart_status_id == 1) {	// HUY
				$this->sentOrderCancel();
			}
			elseif ($this->shopping_cart_status_id == 2) {	// MOI DAT HANG
				$this->sentOrderPurchase();
			}
			elseif ($this->shopping_cart_status_id == 5) {	// DA GIAO HANG
				$this->sentOrderDelivered();
			}	
		} catch (Exception $e) {
			Log::error('Khong gui email hoac sms duoc');
		}
	}

	public function sentOrderPurchase()
	{
		if(!empty($this->customer_email)){
			Mail::to($this->customer_email)
			->cc(Config::getValueByKey('address_received_mail'))
			->send(new OrderPurchase($this));
		}
		elseif(!empty($this->customer_phone)) {
			$this->sentSMS();
		}
	}

	public function sentOrderCancel()
	{
		if(!empty($this->customer_email)){
			Mail::to($this->customer_email)
			->cc(Config::getValueByKey('address_received_mail'))
			->send(new OrderCancel($this));
		}
		elseif(!empty($this->customer_phone)) {
			$this->sentSMS();
		}
	}

	public function sentOrderDelivered()
	{
		if(!empty($this->customer_email)){
			Mail::to($this->customer_email)
			->cc(Config::getValueByKey('address_received_mail'))
			->send(new OrderDelivered($this));
		}
		elseif(!empty($this->customer_phone)) {
			$this->sentSMS();
		}
	}
}
