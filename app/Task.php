<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public $timestamps = false;

	public function creator()
	{
		return $this->hasOne('App\User', 'id', 'creator_id');
	}
}
