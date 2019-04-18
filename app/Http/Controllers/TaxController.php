<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tax;
use Validator;
use Auth;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $taxes = Tax::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.taxes.index',compact('taxes'));
    }

    public function create()
    {
        return view('backend.pages.taxes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentage' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            Tax::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(Tax $tax)
    {
        return view('backend.pages.taxes.edit',compact('tax'));
    }

    public function update(Request $request, Tax $tax)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentage' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $tax->update($request->all());
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
        Tax::destroy($id);
        return redirect()->route('taxes.index')
            ->with('success','delete_msg');
    }
}
