<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Validator;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        $employee_id = $id;
        return view('backend.pages.employees.note.add', compact('employee_id'));
    }

    public function edit($id)
    {
        $note = Note::where('id', $id)->first();
        return view('backend.pages.employees.note.edit', compact('note'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $note = new Note;
            $note->employee_id = $request->id;
            $note->title = $request->title;
            $note->description = $request->description;
            $note->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update(Request $request)
    {
        $note = Note::find($request->id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $note->title = $request->title;
            $note->description = $request->description;
            $note->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        Note::destroy($id);
        return back()->with('success','delete_msg');
    }
}
