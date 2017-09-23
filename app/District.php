<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $fillable = ['id', 'province_id', 'name'];
	public $timestamps = false;

	public function province()
	{
		return $this->belongsTo('App\Province');
	}

	public function wards()
	{
		return $this->hasMany('App\Ward');
	}
}
