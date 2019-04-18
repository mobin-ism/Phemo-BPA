<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use Validator;
use Auth;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $leave_types = LeaveType::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.leave_types.index',compact('leave_types'));
    }

    public function create()
    {
        return view('backend.pages.leave_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            LeaveType::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(LeaveType $leave_type)
    {
        return view('backend.pages.leave_types.edit',compact('leave_type'));
    }

    public function update(Request $request, LeaveType $leave_type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $leave_type->update($request->all());
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
        LeaveType::destroy($id);
        return redirect()->route('leave_types.index')
            ->with('success','delete_msg');
    }
}
