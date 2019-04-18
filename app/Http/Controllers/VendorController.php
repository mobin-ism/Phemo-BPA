<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\User;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewVendorAccount;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$vendors = Vendor::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
        return view('backend.pages.vendors.index', compact('vendors'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_phone' => 'required|numeric',
            'contact_person' => 'required',
            'contact_email' => 'required|email|max:255|unique:vendors,contact_email|unique:users,email',
            'cell_phone' => 'nullable|numeric',
            'city' => 'required',
            'country_id' => 'required'
        ]);

        if ($validator->passes()) {
                $password = random_code(9);
                $user = User::create([
                'name' => $request->contact_person,
                'email' => $request->contact_email,
                'password' => Hash::make($password),
                'role' => 'vendor',
                'account_id' => $request->account_id
            ]);
            Vendor::create(array_merge($request->all(), ['user_id' => $user->id]));
            Notification::route('mail', $request->contact_email)->notify(new NewVendorAccount($request, $password));
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('backend.pages.vendors.show',compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('backend.pages.vendors.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_phone' => 'required|numeric',
            'contact_person' => 'required',
            'contact_email' => 'required|email',
            'cell_phone' => 'nullable|numeric',
            'city' => 'required',
            'country_id' => 'required'
        ]);

        if ($validator->passes()) {
            User::find($vendor->user_id)->update([
                'name' => $request->contact_person,
                'email' => $request->contact_email
            ]);
            $vendor->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function change_status(Request $request)
    {
        $vendor = Vendor::find($request->id);
        $vendor->status = $request->status;
        $vendor->save();
    }
}
