<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Document;
use App\Folder;
use Validator;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $folders = Folder::where('account_id', Auth::user()->account_id)->orderBy('name', 'asc')->get();
        return view('backend.pages.documents.index', compact('folders'));
    }

    public function create($folder_id)
    {
        return view('backend.pages.documents.create', ['folder_id' => $folder_id]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'attachment' => 'required|mimes:pdf|max:5000'
        ]);

        if ($validator->passes()) {
            $document = new Document;
            $document->folder_id = $request->folder_id;
            $document->account_id = $request->account_id;
            $document->notes = $request->notes;
            $document->user_id = Auth::user()->id;
            if ($request->has('attachment')) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->name . '.' . $extension;
                $folder_name = Folder::where('id', $request->folder_id)->first()->name;
                $path = $attachment->storeAs('documents/'.$request->account_id . '/' . $folder_name, $attachment_name);
                $document->path = $path;
                $document->name = $attachment_name;
                $document->extension = $extension;
                $document->size = $attachment->getClientSize();
            }
            $document->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function download($id)
    {
        $filePath = Document::where('id', $id)->first()->path;
        return response()->download(storage_path('app/'.$filePath));
    }

    public function preview($id)
    {
        $filePath = Document::where('id', $id)->first()->path;
        return response()->file(storage_path('app/'.$filePath));
    }

    public function delete($id)
    {
        $filePath = Document::where('id', $id)->first()->path;
        if (file_exists(storage_path('app/' . $filePath))) {
            unlink(storage_path('app/' . $filePath));
        }
        Document::destroy($id);
        return back()->with('success','delete_msg');
    }
}
