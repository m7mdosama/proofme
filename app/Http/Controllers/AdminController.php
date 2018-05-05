<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $roles = Role::get();
        $users = User::get();
        $para = compact(['roles', 'users']);
        return view('admin.index', $para);
    }

    public function save(Request $request)
    {
        if ($request->roleId) {
            $role = Role::find($request->roleId);
            $role->description = $request->desc_txt;
            $role->save();
        } elseif ($request->userId) {
            $user = User::find($request->userId);
            $user->role_id = $request->role;
            $user->save();
        }

        $roles = Role::get();
        $users = User::get();
        $para = compact(['roles', 'users']);
        return view('admin.index', $para);
    }


}
