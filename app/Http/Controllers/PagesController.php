<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('mentor.home');
    }

    public function getStudentIndex()
    {
        $tasks = Auth::user()->task_lists;

        return view('student.home')->withTasks($tasks);
    }

}
