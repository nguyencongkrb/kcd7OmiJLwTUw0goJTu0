<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];
	
	public function articles()
	{
		return $this->morphedByMany('App\Article', 'taggable');
	}

	public function products()
	{
		return $this->morphedByMany('App\Product', 'taggable');
	}

	public function banners()
	{
		return $this->morphedByMany('App\Banner', 'taggable');
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLink()
	{
		return route('tag', ['key' => $this->key]);
	}
}
