<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectType extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	public function parent()
	{
		return $this->belongsTo('App\ProjectType', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ProjectType', 'parent_id');
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->orderBy('priority')->get();
	}
}
