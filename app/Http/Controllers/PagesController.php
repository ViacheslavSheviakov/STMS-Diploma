<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function getAdminIndex()
    {
        $stats = [
            'users_count'  => User::all()->count(),
            'groups_count' => Group::all()->count(),
            'tasks_count'  => Task::all()->count(),
        ];

        return view('admin.home')->withStats($stats);
    }

    public function getMentorIndex()
    {
        $data    = [];

        $data['mentor'] = Auth::user();

        return view('mentor.home')->withData($data);
    }

    public function getStudentIndex()
    {
        $user  = Auth::user();
        $tasks = Auth::user()->task_lists()->orderBy('give_date', 'desc')->paginate(5);
        $data  = [];

        $data['count']     = $tasks->count();
        $data['checking']  = $tasks->where('status', '=', 0)->count();
        $data['in_progress']  = $tasks->where('status', '=', 1)->count();
        $data['expired']   = $tasks->where('status', '=', 2)->count();
        $data['completed'] = $tasks->where('status', '=', 3)->count();

        return view('student.home')->with([
            'tasks' => $tasks,
            'user'  => $user,
            'data'  => $data
        ]);
    }

    public function getUserEdit()
    {
        $user = Auth::user();

        return view('auth.edit')->withUser($user);
    }

    public function getUserEditSave(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user        = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        Session::flash('success', 'E-mail was successfully updated!');

        return redirect()->route('user.edit');
    }

    public function getUserPasswordSave(Request $request)
    {
        $this->validate($request, [
            'pass' => 'required|confirmed'
        ]);

        $user           = Auth::user();
        $user->password = bcrypt($request->input('pass'));
        $user->save();

        Session::flash('success', 'Password was successfully updated!');

        return redirect()->route('user.edit');
    }

    public function getFile($report)
    {
        $rep = Report::find($report);

        return Storage::download($rep->file);
    }

}
