<?php

namespace App;

class ShoppingCartDetail extends BaseModel
{
	protected $fillable = ['shopping_cart_id', 'product_id', 'product_size_id', 'product_color_id', 'product_price', 'quantity'];
	public $timestamps = false;

	public function shoppingCart()
	{
		return $this->belongsTo('App\ShoppingCart', 'shopping_cart_id');
	}

	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	public function size()
	{
		return $this->belongsTo('App\ProductSize', 'product_size_id');
	}

	public function color()
	{
		return $this->belongsTo('App\ProductColor', 'product_color_id');
	}
}
