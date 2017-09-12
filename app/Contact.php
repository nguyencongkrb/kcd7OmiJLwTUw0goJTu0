<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
}
