<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use Illuminate\Support\Facades\Auth;
use Validator;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        $employee_id = $id;
        return view('backend.pages.employees.training.add', compact('employee_id'));
    }

    public function edit($id)
    {
        $training = Training::where('id', $id)->first();
        return view('backend.pages.employees.training.edit', compact('training'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $training = new Training;
            $training->employee_id = $request->id;
            $training->training_type_id = $request->training_type_id;
            $training->description = $request->description;
            $training->duration = $request->duration;
            $training->start = timestamp($request->start);
            $training->end = timestamp($request->end);
            $training->offered_by = $request->offered_by;
            $training->award = $request->award;
            $training->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update(Request $request)
    {
        $training = Training::find($request->id);

        $validator = Validator::make($request->all(), [
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $training->training_type_id = $request->training_type_id;
            $training->description = $request->description;
            $training->duration = $request->duration;
            $training->start = timestamp($request->start);
            $training->end = timestamp($request->end);
            $training->offered_by = $request->offered_by;
            $training->award = $request->award;
            $training->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        Training::destroy($id);
        return back()->with('success','delete_msg');
    }
}
