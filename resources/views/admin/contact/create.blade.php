<x-admin-master>
    @section('content')
        <h1>Create Contact Number for {{$user->name}}</h1>

        @if (Session::has('contact_delete_message'))
            <div class="alert alert-danger">{{Session::get('contact_delete_message')}}</div>
        @elseif (Session::has('contact_create_message'))
            <div class="alert alert-success">{{Session::get('contact_create_message')}}</div>
        @elseif (Session::has('contact_update_message'))
            <div class="alert alert-success">{{Session::get('contact_update_message')}}</div>    
        @elseif (Session::has('contact_type_exists'))
            <div class="alert alert-danger">{{Session::get('contact_type_exists')}}</div>
        @else
        
        @endif

        <form method="post" action="{{route('contact.store', $user->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="contacttype_id">Contact Type</label>
                <select name="contacttype_id"
                        class="form-control"
                        id="contacttype_id"
                        aria-describedby="">
    
                    @foreach($contacttypes as $ct)
                        <option value="{{$ct->id}}">{{$ct->name}}</option>
                    @endforeach       
                </select> 
                
                
                {{--<div class="allert alert-danger">{{$message}}</div>--}}

            </div>

            <div class="form-group">
                <label for="number">Contact Number</label>
                <input type="text"
                        name="number"
                        class="form-control 
                                @error('number')
                                    is-invalid
                                @enderror"
                        id="number"
                        aria-describedby=""
                        placeholder="Enter Contact Number">

                @error('number')
                    <div class="allert alert-danger">{{$message}}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('contact.index', $user->id)}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </form>
    @endsection
</x-admin-master>