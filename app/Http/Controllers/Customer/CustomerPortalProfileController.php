<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\User;
use Validator;

class CustomerPortalProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function profile()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        return view('backend.customers.profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $customer = Customer::find($customer_id);
        if ($request->customer_type == 'company') {
            $name = $request->primary_contact;
            $validate = [
                'company_name' => 'required',
                'primary_contact' => 'required',
                'email' => 'required|email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        } else {
            $name = $request->customer_name;
            $validate = [
                'customer_name' => 'required',
                'surname' => 'required',
                'email' => 'required|email',
                'city' => 'required',
                'country_id' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $validate);

        if ($validator->passes()) {
            User::find($customer->user_id)->update([
                'name' => $name,
                'email' => $request->email
            ]);
            $customer->update($request->all());
            return redirect()->back()->with('success','success_msg');
        }
        return redirect()->back()->withErrors($validator);
    }

    public function photo()
    {
        $id = Customer::where('user_id', Auth::user()->id)->first()->id;
        return view('backend.customers.photo', ['id' => $id]);
    }

    public function update_photo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'mimes:png|max:2000|nullable'
        ]);

        if ($validator->passes()) {
            $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
            $customer = Customer::find($customer_id);
            $account_id = Auth::user()->account_id;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->id . '.' . $extension;
                $path = $attachment->storeAs('public/customer-photos/' . $account_id, $attachment_name);
                $customer->photo = 'customer-photos/' . $account_id . '/' .$attachment_name;
            }
            $customer->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }
}