<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	use \Dimsav\Translatable\Translatable;

	protected $fillable = ['path', 'priority', 'published'];

	public $timestamps = false;

	public $translatedAttributes = ['description'];
	
	/**
	 * Get all of the owning commentable models.
	 */
	public function attachmentable()
	{
		return $this->morphTo();
	}

	public function getLink($template = 'custom', $width = null, $height = null, $fit = 0)
	{
		return route('imagecache', ['template' => $template, 'filename' => $this->path, 'w' => $width, 'h' => $height, 'fit' => $fit]);
	}
}
