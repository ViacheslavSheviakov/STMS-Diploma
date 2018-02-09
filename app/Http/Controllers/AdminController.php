<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AdminController extends Controller
{
    public function getMentorsAttachment()
    {
        $users =
            DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'mentor')
            ->select('users.*', 'roles.name as role_name')
            ->paginate(5);

        return view('admin.attachment')->withUsers($users);
    }

    public function getMentorsAttachmentAdd($id)
    {
        $mentor = User::find($id);

        $data = [];

        $data['id']     = $id;
        $data['groups'] = $mentor->groups;
        $data['select'] = Group::whereNotIn('group_id', $mentor->groups->pluck('group_id'))
                            ->get()
                            ->pluck('short_title', 'group_id');

        return view('admin.mentor')->withData($data);
    }

    public function postMentorsAttachmentAdd(Request $request, $id)
    {
        $this->validate($request, [
            'groups' => 'required'
        ]);

        $mentor  = User::find($id);
        $groupPK = $request->input('groups');

        $mentor->groups()->attach($groupPK);

        Session::flash('success', 'The group was attached!');

        return redirect()->route('admin.attachment.change', $id);
    }

    public function postMentorsAttachmentRemove(Request $request, $id)
    {
        $mentor  = User::find($id);
        $groupPK = $request->input('group');

        $mentor->groups()->detach($groupPK);

        Session::flash('info', 'The group was detached.');

        return redirect()->route('admin.attachment.change', $id);
    }

}
