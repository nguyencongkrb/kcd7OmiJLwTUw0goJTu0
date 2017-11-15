<?php

namespace App;

class Role extends BaseModel
{
	public $timestamps = false;
	
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
