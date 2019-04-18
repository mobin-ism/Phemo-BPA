<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Account;
use App\Customer;
use App\Employee;
use App\Vendor;
use App\User;
use App\Config;
use App\SubscriptionPayment;
use Validator;

class SCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $accounts = Account::orderBy('created_at', 'desc')->get();
        return view('backend.superadmin.company.company', compact('accounts'));
    }

    public function show($id)
    {
        $customers = Customer::where('account_id', $id)->orderBy('created_at', 'desc')->get();
        $employees = Employee::where('account_id', $id)->orderBy('created_at', 'desc')->get();
        $vendors = Vendor::where('account_id', $id)->orderBy('created_at', 'desc')->get();
        $users = User::where('account_id', $id)->orderBy('created_at', 'desc')->get();
        $config = Config::where('account_id', $id)->first();
        return view('backend.superadmin.company.show', compact('customers', 'employees', 'vendors', 'users', 'config'));
    }

    public function summary($id)
    {
        $config = Config::where('account_id', $id)->first();
        return view('backend.superadmin.company.summary', compact('config'));
    }

    public function users(Request $request)
    {
        $type = $request->type;
        $account_id = $request->account_id;
        if ($type == 'customer') {
            $data = Customer::where('account_id', $account_id)->orderBy('created_at', 'desc')->get();
        } else if ($type == 'employee') {
            $data = Employee::where('account_id', $account_id)->orderBy('created_at', 'desc')->get();
        } else if ($type == 'vendor') {
            $data = Vendor::where('account_id', $account_id)->orderBy('created_at', 'desc')->get();
        } else {
            $data = User::where('account_id', $account_id)->orderBy('created_at', 'desc')->get();
        }
        $config = Config::where('account_id', $account_id)->first();
        return view('backend.superadmin.company.users')->with(['data' => $data, 'config' => $config, 'type' => $type]);
    }

    public function credentials($id)
    {
        $user = User::where('id', $id)->first();
        return view('backend.superadmin.email_password', compact('user'));
    }

    public function update_credentials(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255'
        ]);

        if ($validator->passes()) {
            $user_id = $request->user_id;
            $user = User::where('id', $user_id)->first();
            if ($user->email != $request->email) {
                // check if that email exists
                $count = User::where('email', $request->email)->count();
                if ($count < 1) {
                    // we are good to update the email
                    $user->email = $request->email;
                    $user->save();
                    if ($user->role == 'customer') {
                        $customer = Customer::where('user_id', $user->id)->first();
                        $customer->email = $request->email;
                        $customer->save();
                    } else if ($user->role == 'vendor') {
                        $vendor = Vendor::where('user_id', $user->id)->first();
                        $vendor->contact_email = $request->email;
                        $vendor->save();
                    }
                }
            }
            if ($request->password != null && $request->confirm_password != null) {
                if ($request->password == $request->confirm_password) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                }
            }
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function delete_user($id)
    {
        $role = User::where('id', $id)->first()->role;
        if ($role == 'customer') {
            $customer_id = Customer::where('user_id', $id)->first()->id;
            Customer::destroy($customer_id);
        } else if ($role == 'employee') {
            $employee_id = Employee::where('user_id', $id)->first()->id;
            Employee::destroy($employee_id);
        } else if ($role == 'vendor') {
            $vendor_id = Vendor::where('user_id', $id)->first()->id;
            Vendor::destroy($vendor_id);
        }
        User::destroy($id);
        return redirect()->back()->with('success', 'delete_msg');
    }

    public function activity($id)
    {
        $users = User::where('account_id', $id)->orderBy('last_login_at', 'desc')->take(15)->get();
        return view('backend.superadmin.company.activity', compact('users'));
    }

    public function payments($id)
    {
        $payments = SubscriptionPayment::where('account_id', $id)->orderBy('date', 'desc')->get();
        $config = Config::where('account_id', $id)->first();
        return view('backend.superadmin.company.payments', compact('payments', 'config'));   
    }
}