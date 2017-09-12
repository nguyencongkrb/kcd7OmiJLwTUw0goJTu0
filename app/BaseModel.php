<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	public function scopeFindByKey($query, $key)
	{
		return $query->where('key', $key);
	}

	public function userCreated()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function userUpdated()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function attachments()
	{
		return $this->morphMany('App\Attachment', 'attachmentable');
	}

	// required model has relation attachments
	public function getFirstAttachment($template = 'custom', $width = null, $height = null, $fit = null)
	{
		$attachment = $this->attachments()->where('published', 1)->orderBy('priority')->first();
		if (isset($attachment) && !is_null($attachment)) {
			return $attachment->getLink($template, $width, $height, $fit);
		}
		return '';
	}

	// required model has relation attachments
	public function getAttachmentByPriority($priority = 0, $template = 'custom', $width = null, $height = null, $fit = null)
	{
		$attachment = $this->attachments()->where('priority', $priority)->first();
		if (isset($attachment) && !is_null($attachment)) {
			return $attachment->getLink($template, $width, $height, $fit);
		}
		else{
			return $this->getFirstAttachment($template, $width, $height, $fit);
		}
		return '';
	}
}
