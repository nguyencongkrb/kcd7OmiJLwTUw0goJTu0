<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'content', 'link'];

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}
	
	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

    public function bannerCategory()
	{
		return $this->belongsTo('App\BannerCategory');
	}

	public function relatedBanners()
	{
		return $this->belongsToMany('App\Banner', 'related_banners', 'banner_id', 'related_banner_id');
	}

	public function getVisibleRelatedBanners()
	{
		return $this->relatedBanners()->where('published', 1)->orderBy('id', 'desc')->get();
	}

	public function getLink()
	{
		return route('viewVideoGames', ['key' => $this->key]);
	}	
}
