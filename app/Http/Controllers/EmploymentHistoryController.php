<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmploymentHistory;
use Illuminate\Support\Facades\Auth;
use Validator;

class EmploymentHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        $employee_id = $id;
        return view('backend.pages.employees.history.add', compact('employee_id'));
    }

    public function edit($id)
    {
        $history = EmploymentHistory::where('id', $id)->first();
        return view('backend.pages.employees.history.edit', compact('history'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'employer' => 'required',
            'start' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $history = new EmploymentHistory;
            $history->employee_id = $request->id;
            $history->title = $request->title;
            $history->employer = $request->employer;
            $history->start = timestamp($request->start);
            $history->end = timestamp($request->end);
            $history->description = $request->description;
            $history->present = $request->present;
            $history->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update(Request $request)
    {
        $history = EmploymentHistory::find($request->id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'employer' => 'required',
            'start' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $history->title = $request->title;
            $history->employer = $request->employer;
            $history->start = timestamp($request->start);
            $history->end = timestamp($request->end);
            $history->description = $request->description;
            $history->present = $request->present;
            $history->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        EmploymentHistory::destroy($id);
        return back()->with('success','delete_msg');
    }
}
