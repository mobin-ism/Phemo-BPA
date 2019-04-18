<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPermission;
use Auth;

class UserPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
	}
	
	public function index()
	{
		return view('backend.pages.configs.permissions');
	}

	public function save(Request $request)
	{
		if ($request->has('permissions')) {
			$saved = UserPermission::updateOrCreate(
				['user_id' => $request->user_id],
				['permissions' => json_encode($request->permissions)]
			);
		} else {
			$saved = UserPermission::updateOrCreate(
				['user_id' => $request->user_id],
				['permissions' => '[]']
			);
		}
		return redirect()->route('configs.permissions')->with('success','success_msg');
	}

	public function permission_list(Request $request)
	{
		$user_id = $request->user_id;
		return view('backend.pages.configs.permission_list', ['user_id' => $user_id]);
	}
}
