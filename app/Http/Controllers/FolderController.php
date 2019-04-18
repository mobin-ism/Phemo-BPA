<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Folder;
use App\Document;
use Validator;
use File;

class FolderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('backend.pages.folders.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $folder = new Folder;
            $folder->account_id = $request->account_id;
            $folder->user_id = Auth::user()->id;
            $folder->name = $request->name;
            $folder->color = $request->color;
            $folder->save();
            // create the folder in storage
            $path = storage_path('app/documents/' . $request->account_id . '/' . $request->name);
            if (! File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function edit($id)
    {
        $folder = Folder::find($id);
        return view('backend.pages.folders.edit', compact('folder'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        
        if ($validator->passes()) {
            $folder = Folder::find($request->id);
            $account_id = Auth::user()->account_id;
            $prev_name = $folder->name;
            $folder->name = $request->name;
            $folder->color = $request->color;
            if ($prev_name != $request->name) {
                $path = storage_path('app/documents/' . $account_id . '/' . $prev_name);
                $new_path = storage_path('app/documents/' . $account_id . '/' . $request->name);
                rename($path, $new_path);
                // change path of files if there is any file inside that folder
                $documents = Document::where('folder_id', $request->id)->count();
                if ($documents > 0) {
                    $documents = Document::where('folder_id', $request->id)->get();
                    foreach ($documents as $doc) {
                        $doc->path = 'documents/' . $account_id . '/' . $request->name . '/' . $doc->name;
                        $doc->save();
                    }
                }
            }
            $folder->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        return view('backend.pages.folders.show', ['folder_id' => $id]);
    }

    public function delete($id)
    {
        $folder_name = Folder::where('id', $id)->first()->name;
        $folder_path = storage_path('app/documents/' . Auth::user()->account_id . '/' . $folder_name);
        $documents = Document::where('folder_id', $id)->get();
        foreach ($documents as $document) {
            if (file_exists(storage_path('app/'. $document->path))) {
                unlink(storage_path('app/' . $document->path));
            }
            Document::destroy($document->id);
        }
        if (File::exists($folder_path)) {
            File::deleteDirectory($folder_path);
        }
        Folder::destroy($id);
        return redirect()->route('documents.index')->with('success','delete_msg');
    }
}
