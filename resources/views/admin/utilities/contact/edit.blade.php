<x-admin-master>
    @section('content')
        <div class="row">
            @if (Session::has('address_type_delete_message'))
            <div class="alert alert-danger">{{Session::get('address_type_delete_message')}}</div>
            @elseif (Session::has('address_type_create_message'))
            <div class="alert alert-success">{{Session::get('address_type_create_message')}}</div>
            @elseif (Session::has('address_type_update_message'))
            <div class="alert alert-success">{{Session::get('address_type_update_message')}}</div>
            @else

            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Role: {{$addresstypes->name}}</h1>

                <form method='post' action="{{route('addresstype.update', $addresstypes->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                                name="name"
                                class="form-control"
                                id="name"
                                aria-describedby=""
                                placeholder="Enter Name"
                                value="{{$addresstypes->name}}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('addresstype.index')}}" class="btn btn-secondary" role="button" aria-disabled="true">Back</a>
                </form>
            </div>
        </div>  
    @endsection
</x-admin-master>