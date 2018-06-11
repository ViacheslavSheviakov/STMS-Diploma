<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use THelp;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return view('users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['groups'] = Group::all()->pluck('short_title', 'short_title');
        $data['groups'] = collect([null => '-'])->merge($data['groups']);
        $data['roles']  = Role::all()->pluck('name', 'id');

        return view('users.create')->withData($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = redirect()->route('users.index');

        $validator = Validator::make($request->all(), [
            'u-name'       => 'required',
            'u-surname'    => 'required',
            'u-patronymic' => 'required',
            'u-email'      => 'required|email',
            'u-type'       => 'required',
        ]);

        if($validator->fails())
        {
            $response = redirect()->route('users.create');
            Session::flash('error', 'Form was filled incorrectly!');
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

            $user->password = bcrypt('123456');

            if ($request->input('t-token') != null)
            {
                $user->chat_id = $request->input('t-token');
            }

            $user->save();

            $rrole = Role::all()->where('id', $request->input('u-type'))->first();
            $user->roles()->attach($rrole->id);

            THelp::send_message($user->id, "You were signed up as *" . $rrole->name . "*");

            Session::flash('success', 'A new user was successfully created!');
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $data['user'] = User::find($id);
        $data['role'] = $data['user']->roles[0]->name;

        return view('users.show')->withData($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        $user   = User::find($id);
        $role   = $user->roles[0];
        $roles  = Role::all();
        $group  = $user->group_id;

        if ($role->id != 1)
        {
            $tmp = $roles[0];
            $roles[0] = $roles[$role->id - 1];
            $roles[$role->id - 1] = $tmp;
        }

        if ($group == null)
        {
            $groups = Group::all()->pluck('short_title', 'group_id');
            $groups->put(0, '-');
            $data['groups'] = $groups;
            $data['select'] = 0;
        }
        else
        {
            $objGroup = Group::find($group);
            $data['groups'] = Group::all()->pluck('short_title', 'group_id');
            $data['select'] = $group;
        }

        $data['user']  = $user;
        $data['roles'] = $roles->pluck('name', 'id'); 

        return view('users.edit')->withData($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            $user->group_id   = $request->input('a-groups') ? $request->input('a-groups') : null;

            $role = Role::find($request->input('a-roles'));
            $user->detachRoles($user->roles);
            $user->attachRole($role);

            if ($request->input('t-token') != null)
            {
                $user->chat_id = $request->input('t-token');
            }

            $user->save();

            // Set flash data
            Session::flash('success', 'User data was successfully updated!');
        }
        catch (Exception $e)
        {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('users.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('info', 'The user with ID ' . $id . ' was deleted');

        return redirect()->route('users.index');
    }

    /**
     * Restore the password of a specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
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

        return redirect()->route('users.show', $id);
    }
}
