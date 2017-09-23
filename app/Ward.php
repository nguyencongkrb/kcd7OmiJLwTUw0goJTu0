<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
	protected $fillable = ['id', 'district_id', 'name'];
    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo('App\District');
    }
}
