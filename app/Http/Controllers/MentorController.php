<?php

namespace App\Http\Controllers;

use App\User;
use App\TaskList;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use THelp;

class MentorController extends Controller
{
	public function index()
	{
		return view('mentor.home');
	}

	public function getAttachTask($id)
	{
		$user   = Auth::user();
		$groups = $user->groups;

		return view('mentor.attach')->with([
			'groups'  => $groups,
			'task_id' => $id
		]);
	}

	public function postHoleCreate(Request $request)
	{
		$this->validate($request, [
			'task_id'  => 'required',
			'group_id' => 'required'
		]);

		$data = [];

		$data['group_id'] = $request->input('group_id');
		$data['task_id']  = $request->input('task_id');
		$data['students'] = User::where('group_id', '=', $data['group_id'])->orderBy('surname', 'ascgit')->get();

		return view('mentor.hole_group')->withData($data);
	}

	public function postHoleFinish(Request $request)
	{
		$this->validate($request, [
			'task_id'  => 'required',
			'group_id' => 'required',
			'deadline' => 'required|date'
		]);

		$data = [];

		$group_id = $request->input('group_id');
		$task_id  = $request->input('task_id');
		$deadline = $request->input('deadline');

		$students = User::where('group_id', '=', $group_id)->orderBy('surname')->get();

		foreach($students as $student)
		{
			$new_task = new TaskList();

			$new_task->task_id       = $task_id;
			$new_task->doer_id       = $student->id;
			$new_task->give_date     = \Carbon\Carbon::now();
			$new_task->deadline_date = date($deadline);
			$new_task->status        = 1;

			$new_task->save();
		}

		Session::flash('success', 'The task was given to the group successfully!');

		return redirect()->route('tasks.index');
	}

	public function postOne(Request $request)
	{
		$this->validate($request, [
			'task_id'  => 'required',
			'group_id' => 'required'
		]);

		$data = [];

		$data['group_id'] = $request->input('group_id');
		$data['task_id']  = $request->input('task_id');
		$data['students'] = User::where('group_id', '=', $data['group_id'])->orderBy('surname', 'ascgit')->get();

		return view('mentor.one')->withData($data);
	}

	public function postOneStudent(Request $request)
	{
		$this->validate($request, [
			'task_id'    => 'required',
			'student_id' => 'required'
		]);

		$data = [];

		$data['task_id']    = $request->input('task_id');
		$data['student_id'] = $request->input('student_id');

		return view('mentor.one_student')->withData($data);
	}

	public function postOneFinish(Request $request)
	{
		$this->validate($request, [
			'task_id'    => 'required',
			'student_id' => 'required',
			'deadline'   => 'required'
		]);

		$new_task = new TaskList();

		$new_task->task_id       = $request->input('task_id');
		$new_task->doer_id       = $request->input('student_id');
		$new_task->give_date     = \Carbon\Carbon::now();
		$new_task->deadline_date = date($request->input('deadline'));
		$new_task->status        = 1;

		$new_task->save();

		$message = THelp::prepare_task(Auth::user()->id, $request->input('task_id'), $request->input('deadline'));
		THelp::send_message($request->input('student_id'), $message);

		Session::flash('success', 'The task was given to the student successfully!');

		return redirect()->route('tasks.index');
	}

	public function getReports()
	{
		$mentor_id = Auth::user()->id;

		$tasks = 
			DB::table('reports')
				->select('task_lists.id', 'users.surname', 'users.name', 'groups.short_title', 'tasks.title')
				->join('task_lists', 'reports.task_list_id', 'task_lists.id')
				->join('tasks', 'task_lists.task_id', 'tasks.id')
				->join('users', 'task_lists.doer_id', 'users.id')
				->join('groups', 'users.group_id', 'groups.group_id')
				->where('tasks.creator_id', '=', $mentor_id)
				->where('task_lists.status', 'between', '0 and 2')
				->paginate(5);

		return view('mentor.reports')->withTasks($tasks);
	}

	public function getCheckReport($id)
	{
		$task_list = TaskList::find($id);

		return view('mentor.task_report')->withTasklist($task_list);
	}

	public function getApplyStatus(Request $request, $id, $status)
	{
		$task_list         = TaskList::find($id);
		$task_list->status = $status;

		if ($status == 1)
		{
			$this->validate($request, [
				'reason' => 'required'
			]);

			$comment = new Comment();
			$comment->title   = 'Comment';
			$comment->content = $request->input('reason');
			$comment->save();

			$task_list->comment_id = $comment->id;

			$task_list->report->delete();
		}

		$task_list->save();

		Session::flash('info', 'Task status has been updated!');

		return redirect()->route('mentor.reports');
	}

	public function getFinished()
	{
		$mentor_id = Auth::user()->id;

		$tasks = 
			DB::table('task_lists')
				->select('task_lists.id', 'users.surname', 'users.name', 'groups.short_title', 'tasks.title')
				->join('tasks', 'task_lists.task_id', 'tasks.id')
				->join('users', 'task_lists.doer_id', 'users.id')
				->join('groups', 'users.group_id', 'groups.group_id')
				->where('tasks.creator_id', '=', $mentor_id)
				->where('task_lists.status', '=', '3')
				->paginate(5);

		return view('mentor.finished')->withTasks($tasks);
	}

	public function getCheckFinished($id)
	{
		$task_list = TaskList::find($id);

		return view('mentor.task_finished')->withTasklist($task_list);
	}

}
