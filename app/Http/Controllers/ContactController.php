<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Contacttype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(User $user) {
        echo "index";
        $contact = $user->contact;
        return view('admin.contact.index', ['user'=>$user]);
    }

    public function edit(User $user, Contact $contact) {
        return view('admin.contact.edit', [
            'user'=>$user,
            'contact'=>$contact,
        ]);
    }

    public function update(Request $request, User $user, Contact $contact) {
        $inputs = $request->validate([
            'number'=>'required|max:10',
        ]);

        $contact->number = $inputs['number'];

        //$this->authorize('update', $post);
        $contact->save();

        Session::flash('contact_update_message','Contact ' . $contact->id . ' updated');
        return redirect()->route('contact.index', $user->id);
    }
    
    public function create(User $user) {
        //$this->authorize('create', Contact::class);
        $contacttypes = Contacttype::all();
        return view('admin.contact.create', ['user'=>$user, 'contacttypes'=>$contacttypes]);
    }
 
    public function store(Request $request, User $user) {
        //$this->authorize('create', Contact::class);
       
        $inputs = $request->validate([
            'contacttype_id'=>'required',
            'number'=>'required|max:10',
        ]);

        $ct_id = $request->contacttype_id;
        $validate_cont_type = $user->contact()->where('contacttype_id', $ct_id)->get();
        $allswell = true;
        foreach($validate_cont_type as $type) {
            if($type->contacttype_id == $ct_id) {
                $allswell = false;
            }
        }

        if($allswell) {
            $user->contact()->create($inputs);

            Session::flash('contact_create_message', 'Created Contact Number');
            return redirect()->route('contact.index', $user->id);
        }
        else {
            $ct = Contacttype::findOrFail($request->contacttype_id);
            Session::flash('contact_type_exists', 'The Contact type ' . $ct->name . ' alredy created for this user : ' . $user->name . ' - You cannot create more than one '. $ct->name . ' contact');
            return back();
        }
    }
    
    public function destroy(User $user, Contact $contact) {
        $contact->delete();
        Session::flash('contact_delete_message', 'Deleted Contact : ' . $contact->id);
        return back();
    }
}
