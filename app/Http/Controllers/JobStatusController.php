<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobStatus;
use Validator;
use Auth;

class JobStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $job_statuses = JobStatus::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.job_statuses.index',compact('job_statuses'));
    }

    public function create()
    {
        return view('backend.pages.job_statuses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            JobStatus::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(JobStatus $job_status)
    {
        return view('backend.pages.job_statuses.edit',compact('job_status'));
    }

    public function update(Request $request, JobStatus $job_status)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $job_status->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        JobStatus::destroy($id);
        return redirect()->route('job_statuses.index')
            ->with('success','delete_msg');
    }
}
