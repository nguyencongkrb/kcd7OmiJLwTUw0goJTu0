<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartStatus extends Model
{
	protected $fillable = ['name'];
	public $timestamps = false;

	public function shoppingcarts()
	{
		return $this->hasMany('App\ShoppingCart');
	}
}
