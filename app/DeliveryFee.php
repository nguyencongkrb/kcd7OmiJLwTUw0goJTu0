<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends BaseModel
{
	protected $fillable = ['min_weight', 'max_weight', 'area_info_id', 'fee'];
	public $timestamps = false;
}
