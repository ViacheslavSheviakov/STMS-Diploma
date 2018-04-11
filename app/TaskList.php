<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
	public $timestamps = false;

	public function task()
	{
		return $this->hasOne('App\Task', 'id', 'task_id');
	}

	public function report()
	{
		return $this->belongsTo('App\Report', 'id', 'task_list_id');
	}

	public function doer()
	{
		return $this->hasOne('App\User', 'id', 'doer_id');
	}

	public function comment()
	{
		return $this->hasOne('App\Comment', 'id', 'comment_id');
	}
}
