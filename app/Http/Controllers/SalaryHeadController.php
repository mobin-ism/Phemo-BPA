<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryHead;
use Validator;
use Auth;

class SalaryHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salary_heads = SalaryHead::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.salary_heads.index',compact('salary_heads'));
    }

    public function create()
    {
        return view('backend.pages.salary_heads.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->passes()) {
            SalaryHead::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(SalaryHead $salary_head)
    {
        return view('backend.pages.salary_heads.edit',compact('salary_head'));
    }

    public function update(Request $request, SalaryHead $salary_head)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->passes()) {
            $salary_head->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function destroy($id)
    {
        
    }

    public function delete($id)
    {
        SalaryHead::destroy($id);
        return redirect()->route('salary_heads.index')->with('success','delete_msg');
    }
}
