<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerCategory extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function banners()
	{
		return $this->hasMany('App\Banner');
	}
}
