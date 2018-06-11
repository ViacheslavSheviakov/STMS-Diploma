<?php

namespace App\Http\Controllers;

use App\TaskList;
use App\Task;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use THelp;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.home');
    }

    public function postTask(Request $request)
    {
        $this->validate($request, [
            'tasklist_id' => 'required|integer'
        ]);

        $tasklist = TaskList::find($request->input('tasklist_id'));

        return view('student.task')->withTasklist($tasklist);
    }

    public function postReportSave(Request $request)
    {
        $this->validate($request, [
            'tasklist_id' => 'required|integer',
            'content'     => 'required',
            'file'        => 'max:10240'
        ]);

        $tasklist = TaskList::find($request->input('tasklist_id'));
        $report = new Report();

        if($request->has('file'))
        {
            $file = $request->file('file');

            $ext = $file->getClientOriginalExtension();

            $file_name  = Auth::user()->surname . '_';
            $file_name .= date('dmYHis');
            $file_name .= '.' . $ext;

            $destinationPath  = 'uploads/';
            $destinationPath .= Auth::user()->surname . '_' . Auth::user()->id;

            $path = Storage::putFileAs($destinationPath, $file, $file_name);

            $report->file = $path;
        }

        $tasklist->status = 0;
        $tasklist->save();

        $report->task_list_id = $request->input('tasklist_id');
        $report->contents     = $request->input('content');

        $report->save();

        $message = THelp::prepare_report(Auth::user()->id, $request->input('tasklist_id'), $request->input('content'));
        THelp::send_message(Task::find($tasklist->task_id)->creator_id, $message);

        Session::flash('info', 'Report was sent!');

        return redirect()->route('home.student');
    }
}
