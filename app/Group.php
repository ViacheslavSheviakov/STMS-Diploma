<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $primaryKey = 'group_id';
	public $incrementing = false;
	public $timestamps = false;

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
