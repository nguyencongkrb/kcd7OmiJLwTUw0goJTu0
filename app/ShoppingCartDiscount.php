<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartDiscount extends Model
{
	protected $fillable = ['area_info_id', 'min_value', 'max_value', 'discount_percentage'];
	public $timestamps = false;
}
