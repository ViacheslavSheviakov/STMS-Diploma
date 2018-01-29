<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count'   => User::all()->count(),
            'groups_count'  => Group::all()->count(),
            'tasks_count'   => Task::all()->count(),
        ];

        return view('admin.home')->with(['stats' => $stats]);
    }

    public function createUser()
    {
        $groups = Group::all();
        $roles = Role::all();

        return view('admin.create-user')->with(['groups' => $groups, 'roles' => $roles]);
    }

    public function saveUser(Request $request)
    {
        $response = redirect()->route('admin.users.change');

        $validator = Validator::make($request->all(), [
            'u-name'        => 'required',
            'u-surname'     => 'required',
            'u-patronymic'  => 'required',
            'u-email'       => 'required|email',
            'u-type'        => 'required',
        ]);

        if($validator->fails())
        {
            $response = redirect()->route('admin.user.new');
        }
        else
        {
            $user = new User();
            $user->name         = $request->input('u-name');
            $user->surname      = $request->input('u-surname');
            $user->patronymic   = $request->input('u-patronymic');
            $user->email        = $request->input('u-email');
            $user->password     = bcrypt('123456');
            $user->save();

            $user->roles()->attach(Role::all()->where('id', $request->input('u-type'))->first()->id);
        }

        return $response;
    }

    public function changeUsers()
    {
        $users = User::paginate(5);

        return view('admin.change-users')->with(['users' => $users]);
    }

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin.edit-user')->with(['user' => $user]);
    }

    public function delUser()
    {
        return '';
    }

}
