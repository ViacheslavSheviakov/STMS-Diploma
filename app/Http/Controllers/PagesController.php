<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;

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
        return view('student.home');
    }

}
