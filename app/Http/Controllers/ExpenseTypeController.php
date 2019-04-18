<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseType;
use Auth;
use Validator;

class ExpenseTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expense_types = ExpenseType::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.expense_types.index',compact('expense_types'));
    }

    public function create()
    {
        return view('backend.pages.expense_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            ExpenseType::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        
    }
    
    public function edit(ExpenseType $expense_type)
    {
        return view('backend.pages.expense_types.edit',compact('expense_type'));
    }

    public function update(Request $request, ExpenseType $expense_type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $expense_type->update($request->all());
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
        ExpenseType::destroy($id);
        return redirect()->route('expense_types.index')
            ->with('success','delete_msg');
    }
}
