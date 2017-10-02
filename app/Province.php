<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Province extends Model
{
	protected $fillable = ['id', 'name'];
	public $timestamps = false;

	public function areaInfo()
	{
		return $this->belongsTo('App\AreaInfo');
	}

	public function districts()
	{
		return $this->hasMany('App\District');
	}
	
	public function shoppingCarts()
	{
		return $this->hasMany('App\ShoppingCart');
	}

	public function shippingShoppingCarts()
	{
		return $this->hasMany('App\ShoppingCart', 'shipping_province_id');
	}

	public function getStandardDeliveryTime()
	{
		return Carbon::now()->addWeekdays($this->areaInfo->standard_delivery_days);
	}

	public function getExpressDeliveryTime()
	{
		return Carbon::now()->addWeekdays($this->areaInfo->express_delivery_days);
	}

	public function getDeliveryFee($weight)
	{
		$fee = 0;
		$deliveryFees = $this->areaInfo->deliveryFees()->orderBy('max_weight', 'desc')->get();
		$max_weight = $deliveryFees->first()->max_weight;
		//return $max_weight;
		if($weight > $max_weight){
			$fee = $deliveryFees->first()->fee;

			$extend_weight = $weight - $max_weight;
			$fee += ceil($extend_weight/500) * $this->areaInfo->extend_delivery_fee;
		}
		else{
			foreach ($deliveryFees as $deliveryFee) {
				if($weight >= $deliveryFee->min_weight && $weight < $deliveryFee->max_weight){
					$fee = $deliveryFee->fee;
					break;
				}
			}
		}
		return $fee;
	}
}
