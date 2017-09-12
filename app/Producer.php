<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function getLink()
	{
		return route('producer', ['key' => $this->key]);
	}
}
