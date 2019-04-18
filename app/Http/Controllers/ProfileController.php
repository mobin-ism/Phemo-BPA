<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change_password()
    {
        return view('backend.pages.profiles.change_password');
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->passes()) {
            $current_password = Auth::user()->password;
            if (Hash::check($request->current_password, $current_password)) {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->password);
                $user->save();
                $request->session()->flash('success', 'success_msg');
                return response()->json(['success' => '1']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function change_photo()
    {
        return view('backend.pages.profiles.change_photo');
    }

    public function update_photo(Request $request)
    {

    }
}