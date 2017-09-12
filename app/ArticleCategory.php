<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function articles()
	{
		return $this->belongsToMany('App\Article');
	}

	public function parent()
	{
		return $this->belongsTo('App\ArticleCategory', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ArticleCategory', 'parent_id');
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLink()
	{
		return route('articles', ['key' => $this->key]);
	}
}
