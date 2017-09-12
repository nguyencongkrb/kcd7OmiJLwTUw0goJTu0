<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Config;
use DateTime;

class Project extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'client_name', 'summary', 'description', 'meta_description', 'meta_keywords'];
	protected $dates = ['deleted_at'];

	public function projectCategories()
	{
		return $this->belongsToMany('App\ProjectCategory');
	}

	public function projectTypes()
	{
		return $this->belongsToMany('App\ProjectType');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function nextProject()
	{
		return Project::where('id', '>', $this->id)->where('published', 1)->orderBy('id', 'desc')->first();
	}

	public function previousProject()
	{
		return Project::where('id', '<', $this->id)->where('published', 1)->orderBy('id', 'desc')->first();
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}

	public function getLink()
	{
		$firstCategory = $this->projectCategories()->first();
		if ($firstCategory) {
			return route('project', ['categorykey' => $firstCategory->key, 'key' => $this->key]);
		}
		return '';
	}
}
