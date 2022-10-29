<?php

namespace App\Http\Controllers;


use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index() {
        return view('admin.permissions.index', [
            'permissions'=> Permission::all()
        ]);
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', [
            'permission'=>$permission,
            'roles'=>Role::all()
        ]);
    }

    public function update(Permission $permission) {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')) {
            $permission->save();
            Session::flash('permission_update_message', 'Permission updated :' . $permission->name);
        }
        else {            
            Session::flash('permission_update_message', 'No chahnge detected, Nothing was updated');
        }
        return back();
    }

    public function store() {
        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug("-")
        ]);
        Session::flash('permission_create_message', 'Created permission');
        return back();
    }

    public function attach_role(Permission $permission) {
        $permission->roles()->attach(request('role'));
        return back();
    }

    public function detach_permission(Permission $permission) {
        $permission->roles()->detach(request('role'));
        return back();
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        Session::flash('permission_delete_message', 'Deleted Permission : ' . $permission->name);
        return back();
    }

}
