<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function products()
	{
		return $this->belongsToMany('App\Product');
	}

	public function parent()
	{
		return $this->belongsTo('App\ProductType', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ProductType', 'parent_id');
	}
}
