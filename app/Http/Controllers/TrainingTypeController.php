<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingType;
use Validator;
use Auth;

class TrainingTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $training_types = TrainingType::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.training_types.index',compact('training_types'));
    }

    public function create()
    {
        return view('backend.pages.training_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            TrainingType::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(TrainingType $training_type)
    {
        return view('backend.pages.training_types.edit',compact('training_type'));
    }

    public function update(Request $request, TrainingType $training_type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $training_type->update($request->all());
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
        TrainingType::destroy($id);
        return redirect()->route('training_types.index')
            ->with('success','delete_msg');
    }
}
