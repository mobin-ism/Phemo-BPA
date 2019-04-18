<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerCategory;
use Validator;
use Auth;

class CustomerCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = CustomerCategory::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.customer_categories.index',compact('categories'));
    }

    public function create()
    {
        return view('backend.pages.customer_categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            CustomerCategory::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show($id)
    {
        
    }

    public function edit(CustomerCategory $customer_category)
    {
        return view('backend.pages.customer_categories.edit',compact('customer_category'));
    }

    public function update(Request $request, CustomerCategory $customer_category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            $customer_category->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        CustomerCategory::destroy($id);
        return redirect()->route('customer_categories.index')
            ->with('success','delete_msg');
    }
}
