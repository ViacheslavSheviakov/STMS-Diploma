<?php

namespace App\Http\Controllers;

use App\User;
use App\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        Session::flash('success', 'The task was given to the student successfully!');

        return redirect()->route('tasks.index');
    }

}
