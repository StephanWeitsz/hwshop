<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Addresstype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    public function index(User $user) {
        $address = $user->address;

        return view('admin.address.index', ['user'=>$user]);
    }

    public function edit(User $user, Address $address) {
        return view('admin.address.edit', [
            'user'=>$user,
            'address'=>$address,
        ]);
    }

    public function update(Request $request, User $user, Address $address) {

        $inputs = $request->validate([
            'line1'=>'required',
            'line2'=>'required',
            'line3'=>'nullable|sometimes',
            'line4'=>'nullable|sometimes',
            'postalcode'=>'required|max:4',
            'lat'=>'nullable|sometimes',
            'long'=>'nullable|sometimes',
        ]);

        $address->line1 = $inputs['line1'];
        $address->line2 = $inputs['line2'];
        $address->line3 = $inputs['line3'];
        $address->line4 = $inputs['line4'];
        $address->postalcode = $inputs['postalcode'];
        $address->lat = $inputs['lat'];
        $address->long = $inputs['long'];

        //$this->authorize('update', $post);
        $address->save();

        Session::flash('address_update_message','Address ' . $address->id . ' updated');
        return redirect()->route('address.index', $user->id);

    }
    
    public function create(User $user) {
        //$this->authorize('create', Address::class);
        $addresstypes = Addresstype::all();
        return view('admin.address.create', ['user'=>$user, 'addresstypes'=>$addresstypes]);
    }

    
    public function store(Request $request, User $user) {
        
        //$this->authorize('create', Address::class);
       
        $inputs = $request->validate([
            'addresstype_id'=>'required',
            'line1'=>'required',
            'line2'=>'required',
            'line3'=>'nullable|sometimes',
            'line4'=>'nullable|sometimes',
            'postalcode'=>'required|max:4',
            'lat'=>'nullable|sometimes',
            'long'=>'nullable|sometimes',
        ]);

        $at_id = $request->addresstype_id;
        $validate_addr_type = $user->address()->where('addresstype_id', $at_id)->get();
        $allswell = true;
        foreach($validate_addr_type as $type) {
            if($type->addresstype_id  == $at_id) {
                $allswell = false;
            }
        }

        if($allswell) {
            $user->address()->create($inputs);

            Session::flash('address_create_message', 'Created Address');
            return redirect()->route('address.index', $user->id);
        }
        else {
            $at = Addresstype::findOrFail($request->addresstype_id);
            Session::flash('address_type_exists', 'The Address type ' . $at->name . ' alredy created for this user : ' . $user->name . ' - You cannot create more than one '. $at->name . ' address');
            return back();
        }
    }
    
    public function destroy(User $user, Address $address) {
        $address->delete();
        Session::flash('address_delete_message', 'Deleted Address : ' . $address->id);
        return back();
    }
}
