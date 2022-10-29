<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index() {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function edit(Role $role) {
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions'=>Permission::all()
        ]);
    }

    public function update(Role $role) {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')) {
            $role->save();
            Session::flash('role_update_message', 'Role updated :' . $role->name);
        }
        else {            
            Session::flash('role_update_message', 'No chahnge detected, Nothing was updated');
        }
        return back();
    }

    public function store() {
        request()->validate([
            'name'=>['required']
        ]);

        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug("-")
        ]);
        Session::flash('role_create_message', 'Created Role');
        return back();
    }

    public function attach_permission(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role) {
        $role->delete();
        Session::flash('role_delete_message', 'Deleted Role : ' . $role->name);
        return back();
    }

}
