<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function create(){
        $roles = Role::all();
        return view('user.create',compact('roles'));
    }

    function store(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = bcrypt($request->password);
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        return back();
    }

    function show(){
      return  User::with('roles')->get();
    }

}
