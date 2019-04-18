<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use Illuminate\Support\Facades\Auth;
use Validator;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        $employee_id = $id;
        return view('backend.pages.employees.asset.add', compact('employee_id'));
    }

    public function edit($id)
    {
        $asset = Asset::where('id', $id)->first();
        return view('backend.pages.employees.asset.edit', compact('asset'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'serial' => 'required',
            'date_acquired' => 'required'
        ]);

        if ($validator->passes()) {
            $asset = new Asset;
            $asset->employee_id = $request->id;
            $asset->name = $request->name;
            $asset->serial = $request->serial;
            $asset->make = $request->make;
            $asset->value = $request->value;
            $asset->date_acquired = strtotime($request->date_acquired);
            $asset->date_returned = strtotime($request->date_returned);
            $asset->date_assigned = strtotime($request->date_assigned);
            $asset->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function update(Request $request)
    {
        $asset = Asset::find($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'serial' => 'required',
            'date_acquired' => 'required'
        ]);

        if ($validator->passes()) {
            $asset->name = $request->name;
            $asset->serial = $request->serial;
            $asset->make = $request->make;
            $asset->value = $request->value;
            $asset->date_acquired = strtotime($request->date_acquired);
            $asset->date_returned = strtotime($request->date_returned);
            $asset->date_assigned = strtotime($request->date_assigned);
            $asset->save();

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        Asset::destroy($id);
        return back()->with('success','delete_msg');
    }
}
