<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
	protected $fillable = ['id', 'name'];
	public $timestamps = false;

	public function districts()
	{
		return $this->hasMany('App\District');
	}
}
