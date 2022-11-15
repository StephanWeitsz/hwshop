<?php

namespace App\Http\Controllers;

use App\Models\Contacttype;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactTypeController extends Controller
{
    public function index() {
        return view('admin.utilities.contact.index', [
            'cts' => Contacttype::all()
        ]);
    }

    public function edit(Contacttype $contacttype) {
        return view('admin.utilities.contact.edit', [
            'contacttype'=>$contacttype
        ]);
    }

    public function update(Contacttype $contacttype) {
        $contacttype->name = Str::ucfirst(request('name'));

        if($contacttype->isDirty('name')) {
            $contacttype->save();
            Session::flash('contact_type_update_message', 'Contact Type updated :' . $contacttype->name);
        }
        else {            
            Session::flash('contact_type_update_message', 'No chahnge detected, Nothing was updated');
        }
        return back();
    }

    public function store() {
        request()->validate([
            'name'=>['required']
        ]);

        Contacttype::create([
            'name'=> Str::ucfirst(request('name')),
        ]);
        Session::flash('contact_type_create_message', 'Created Contact Type');
        return back();
    }
    
    public function destroy(Contacttype $contacttype) {
        $contacttype->delete();
        Session::flash('contact_type_delete_message', 'Deleted Contact Type : ' . $contacttype->name);
        return back();
    }
}
