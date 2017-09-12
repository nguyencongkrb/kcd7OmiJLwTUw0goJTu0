<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalValue extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'content'];
	protected $dates = ['deleted_at'];

	public function category()
	{
		return $this->belongsTo('App\AdditionalCategory');
	}
}
