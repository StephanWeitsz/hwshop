<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    public function create() {
    }

    public function show(User $user) {
        return view('admin.users.profile', [
            'user'=>$user,
            'roles'=>Role::all()
        ]);
    }



    public function update(User $user) {
        $inputs = request()->validate([
            'username'=> ['required', 'string', 'max:255', 'alpha_dash'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar'=> ['file'],
            'note'=>['string', 'max:255'],
        ]);

        //'password'=> ['min:6', 'max:255', 'confirmed']
        //'password'=> ['required', 'string', 'min:8', 'confirmed']

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);
        Session::flash('user_update_message', 'User ' . $user->id . ' was updated');
        return back();
    }

    public function attach(User $user) {
        $user->roles()->attach(request('role'));
        return back();     
    }

    public function detach(User $user) {
        $user->roles()->detach(request('role'));
        return back();     
    }

    public function destroy(User $user) {
        $this->delete();
        Session::flash('user_delete_message', 'User has been deleted');
        return back();
    }
}
