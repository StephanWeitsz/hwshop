<x-admin-master>
    @section('content')
        <h1>Create Address for {{$user->name}}</h1>

        @if (Session::has('address_delete_message'))
            <div class="alert alert-danger">{{Session::get('address_delete_message')}}</div>
        @elseif (Session::has('address_create_message'))
            <div class="alert alert-success">{{Session::get('address_create_message')}}</div>
        @elseif (Session::has('address_update_message'))
            <div class="alert alert-success">{{Session::get('address_update_message')}}</div>    
        @elseif (Session::has('address_type_exists'))
            <div class="alert alert-danger">{{Session::get('address_type_exists')}}</div>
        @else
        
        @endif

        <form method="post" action="{{route('address.store', $user->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="addresstype_id">Address Type</label>
                <select name="addresstype_id"
                        class="form-control"
                        id="addresstype_id"
                        aria-describedby="">
    
                    @foreach($addresstypes as $at)
                        <option value="{{$at->id}}">{{$at->name}}</option>
                    @endforeach       
                </select> 
                
                
                {{--<div class="allert alert-danger">{{$message}}</div>--}}

            </div>

            <div class="form-group">
                <label for="line1">Address</label>
                <input type="text"
                        name="line1"
                        class="form-control 
                                @error('line1')
                                    is-invalid
                                @enderror"
                        id="line1"
                        aria-describedby=""
                        placeholder="Enter Address">

                @error('line1')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text"
                        name="line2"
                        class="form-control 
                                @error('line2')
                                    is-invalid
                                @enderror"
                        id="line2"
                        aria-describedby="">

                @error('line2')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text"
                        name="line3"
                        class="form-control 
                                @error('line3')
                                    is-invalid
                                @enderror"
                        id="line3"
                        aria-describedby=""
                        placeholder="">

                @error('line3')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text"
                        name="line4"
                        class="form-control 
                                @error('line4')
                                    is-invalid
                                @enderror"
                        id="line4"
                        aria-describedby=""
                        placeholder="">

                @error('line4')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="postalcode">Postal Code</label>
                <input type="text"
                        name="postalcode"
                        class="form-control 
                                @error('postalcode')
                                    is-invalid
                                @enderror"
                        id="postalcode"
                        aria-describedby=""
                        placeholder="">
                        
                @error('postalcode')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lat">Latetude</label>
                <input type="text"
                        name="lat"
                        class="form-control 
                                @error('lat')
                                    is-invalid
                                @enderror"
                        id="lat"
                        aria-describedby=""
                        placeholder="">

                @error('lat')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="long">Longdetude</label>
                <input type="text"
                        name="long"
                        class="form-control 
                                @error('long')
                                    is-invalid
                                @enderror"
                        id="long"
                        aria-describedby=""
                        placeholder="">

                @error('long')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('address.index', $user->id)}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </form>
    @endsection
</x-admin-master>