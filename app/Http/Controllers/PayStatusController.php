<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayStatus;
use Validator;
use Auth;

class PayStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pay_statuses = PayStatus::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.pay_statuses.index',compact('pay_statuses'));
    }

    public function create()
    {
        return view('backend.pages.pay_statuses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            PayStatus::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        //
    }
    
    public function edit(PayStatus $pay_status)
    {
        return view('backend.pages.pay_statuses.edit',compact('pay_status'));
    }

    public function update(Request $request, PayStatus $pay_status)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $pay_status->update($request->all());
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
        PayStatus::destroy($id);
        return redirect()->route('pay_statuses.index')
            ->with('success','delete_msg');
    }
}
