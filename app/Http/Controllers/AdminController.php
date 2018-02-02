<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count'  => User::all()->count(),
            'groups_count' => Group::all()->count(),
            'tasks_count'  => Task::all()->count(),
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
        $response = redirect()->route('admin.users.show');

        $validator = Validator::make($request->all(), [
            'u-name'       => 'required',
            'u-surname'    => 'required',
            'u-patronymic' => 'required',
            'u-email'      => 'required|email',
            'u-type'       => 'required',
        ]);

        if($validator->fails())
        {
            $response = redirect()->route('admin.user.new');
        }
        else
        {
            $user = new User();
            $user->name       = $request->input('u-name');
            $user->surname    = $request->input('u-surname');
            $user->patronymic = $request->input('u-patronymic');
            $user->email      = $request->input('u-email');

            if ($request->input('u-group'))
            {
                $group = Group::all()->where('short_title', '=', $request->input('u-group'))->first();
                $user->group_id = $group->id;
            }

            $user->password   = bcrypt('123456');
            $user->save();

            $user->roles()->attach(Role::all()->where('id', $request->input('u-type'))->first()->id);
        }

        return $response;
    }

    public function showUsers()
    {
        $users = User::paginate(5);

        return view('admin.show-users')->with(['users' => $users]);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $role = $user->roles[0];
        $roles = Role::all();

        if ($role->id != 1) {
            $tmp = $roles[0];
            $roles[0] = $roles[$role->id - 1];
            $roles[$role->id - 1] = $tmp;
        }

        return view('admin.edit-user')->with(['user' => $user, 'roles' => $roles]);
    }

    public function delUser($id)
    {
        User::destroy($id);

        Session::flash('info', 'The user with ID '.$id.' was deleted');

        return redirect()->route('admin.users.show');
    }

    public function passRestore($id)
    {
        try
        {
            $user = User::find($id);
            $user->password = bcrypt('123456');
            $user->save();
            Session::flash('success', 'The password was successfully restored!');
        }
        catch (Exception $e)
        {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('admin.users.edit', $id);
    }

    public function updateUser(Request $request, $id)
    {
        // Validating the data
        $this->validate($request, [
            'name'       => 'required',
            'surname'    => 'required',
            'patronymic' => 'required',
            'email'      => 'required|email',
            'a-roles'    => 'required',
        ]);

        try
        {
            // Save the data to the database
            $user = User::find($id);

            $user->name       = $request->input('name');
            $user->surname    = $request->input('surname');
            $user->patronymic = $request->input('patronymic');
            $user->email      = $request->input('email');

            $role = Role::find($request->input('a-roles'));
            $user->detachRoles($user->roles);
            $user->attachRole($role);

            $user->save();

            // Set flash data
            Session::flash('success', 'User data was successfully updated!');
        }
        catch (Exception $e)
        {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('admin.users.edit', $id);
    }

    public function showGroups()
    {
        $groups = Group::paginate(5);

        return view('admin.show-groups')->with(['groups' => $groups]);
    }

    public function createGroup()
    {
        return view('admin.create-group');
    }

    public function saveGroup(Request $request)
    {
        $response = redirect()->route('admin.groups.show');

        $validator = Validator::make($request->all(), [
            'short-title' => 'required',
            'full-title'  => 'required',
        ]);

        if($validator->fails())
        {
            $response = redirect()->route('admin.group.new');
        }
        else
        {
            $group = new Group();

            $group->short_title = $request->input('short-title');
            $group->full_title  = $request->input('full-title');

            $group->save();
        }

        return $response;
    }

    public function editGroup($id)
    {
        $group = Group::find($id);

        return view('admin.edit-group')->with(['group' => $group]);
    }

    public function updateGroup(Request $request, $id)
    {
        // Validating the data
        $this->validate($request, [
            'short_title' => 'required',
            'full_title'  => 'required',
        ]);

        try
        {
            // Save the data to the database
            $group = Group::find($id);

            $group->short_title = $request->input('short_title');
            $group->full_title  = $request->input('full_title');

            $group->save();

            // Set flash data
            Session::flash('success', 'Group data was successfully updated!');
        }
        catch (Exception $e)
        {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('admin.group.edit', $id);
    }

}
