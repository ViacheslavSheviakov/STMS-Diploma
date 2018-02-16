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
}
