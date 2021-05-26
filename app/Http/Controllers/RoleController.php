<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $user;
    public function __construct()
    {
     $this->user = Auth::guard('web')->user();
    }

    public function index(){

       /* if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role.');
        }*/
        $roles = Role::SimplePaginate(10);
        return view('role.index',compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::latest()->get();
        $permission_groups = User::getPermissionGroup();
        return view('role.create',compact('permissions', 'permission_groups'));
    }
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return back();
    }


}
