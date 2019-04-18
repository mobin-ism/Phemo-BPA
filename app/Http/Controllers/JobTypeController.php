<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobType;
use Validator;
use Auth;

class JobTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $job_types = JobType::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.job_types.index',compact('job_types'));
    }

    public function create()
    {
        return view('backend.pages.job_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            JobType::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(JobType $job_type)
    {
        return view('backend.pages.job_types.edit',compact('job_type'));
    }

    public function update(Request $request, JobType $job_type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $job_type->update($request->all());
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
        JobType::destroy($id);
        return redirect()->route('job_types.index')
            ->with('success','delete_msg');
    }
}
