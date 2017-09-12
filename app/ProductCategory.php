<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
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
		return $this->belongsTo('App\ProductCategory', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ProductCategory', 'parent_id');
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLink()
	{
		return route('products', ['key' => $this->key]);
	}
}
