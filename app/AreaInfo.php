<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaInfo extends BaseModel
{
	protected $fillable = ['name', 'standard_delivery_days', 'express_delivery_days', 'extend_delivery_fee'];
	public $timestamps = false;

	public function deliveryFees()
	{
		return $this->hasMany('App\DeliveryFee');
	}
}
