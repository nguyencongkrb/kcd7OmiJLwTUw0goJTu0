<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends BaseModel
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	public function commentable()
	{
		return $this->morphTo();
	}
}
