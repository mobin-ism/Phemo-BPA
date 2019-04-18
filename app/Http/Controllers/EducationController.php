<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;
use Illuminate\Support\Facades\Auth;
use Validator;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        $employee_id = $id;
        return view('backend.pages.employees.education.add', compact('employee_id'));
    }

    public function edit($id)
    {
        $education = Education::where('id', $id)->first();
        return view('backend.pages.employees.education.edit', compact('education'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institution' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'gpa' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        if ($validator->passes()) {
            $education = new Education;
            $education->employee_id = $request->id;
            $education->institution = $request->institution;
            $education->degree = $request->degree;
            $education->major = $request->major;
            $education->gpa = $request->gpa;
            $education->start = timestamp($request->start);
            $education->end = timestamp($request->end);
            $education->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update(Request $request)
    {
        $education = Education::find($request->id);

        $validator = Validator::make($request->all(), [
            'institution' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'gpa' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        if ($validator->passes()) {
            $education->institution = $request->institution;
            $education->degree = $request->degree;
            $education->major = $request->major;
            $education->gpa = $request->gpa;
            $education->start = timestamp($request->start);
            $education->end = timestamp($request->end);
            $education->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        Education::destroy($id);
        return back()->with('success','delete_msg');
    }
}
