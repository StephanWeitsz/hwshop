<?php

namespace App\Http\Controllers;

use App\Models\Addresstype;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddressTypeController extends Controller
{
    public function index() {
        return view('admin.utilities.address.index', [
            'ats' => Addresstype::all()
        ]);
    }

    public function edit(Addresstype $addresstype) {
        return view('admin.utilities.address.edit', [
            'addresstype'=>$addresstype
        ]);
    }

    public function update(Addresstype $addresstype) {
        $addresstype->name = Str::ucfirst(request('name'));

        if($addresstype->isDirty('name')) {
            $addresstype->save();
            Session::flash('address_type_update_message', 'Address Type updated :' . $addresstype->name);
        }
        else {            
            Session::flash('address_type_update_message', 'No chahnge detected, Nothing was updated');
        }
        return back();
    }

    public function store() {
        request()->validate([
            'name'=>['required']
        ]);

        Addresstype::create([
            'name'=> Str::ucfirst(request('name')),
        ]);
        Session::flash('address_type_create_message', 'Created Address Type');
        return back();
    }
    
    public function destroy(Addresstype $addresstype) {
        $addresstype->delete();
        Session::flash('address_type_delete_message', 'Deleted Address Type : ' . $addresstype->name);
        return back();
    }
}
