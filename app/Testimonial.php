<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['full_name', 'job_title', 'company_name', 'content'];
}
