<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::paginate(5);

        return view('groups.index')->withGroups($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = redirect()->route('groups.index');

        $validator = Validator::make($request->all(), [
            'short-title' => 'required',
            'full-title'  => 'required',
        ]);

        if($validator->fails())
        {
            $response = redirect()->route('groups.create');
            Session::flash('error', 'Form was filled incorrectly!');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);

        return view('groups.show')->withGroup($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);

        return view('groups.edit')->withGroup($group);
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

        return redirect()->route('groups.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
        Session::flash('info', 'The group with ID ' . $id . ' was deleted');

        return redirect()->route('groups.index');
    }
}
