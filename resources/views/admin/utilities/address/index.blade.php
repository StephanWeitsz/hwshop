<x-admin-master>
    @section('content')
      <h1>Maintain Address Types</h1>

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
        <div class="col-sm-3">
          <form method="post" action="{{route('addressType.store')}}">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>  
              <input type="text"
                      name="name" 
                      id="name"
                      class="form-control @error('name') is-invalid @enderror">
  
              <div>
                @error('name')
                  <span><strong>{{$message}}</strong></span>    
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create</button>
          </form>
        </div>
  
        <div class="col-sm-9">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Address Type List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($ats as $at)                      
                      <tr>
                        <td>{{$at->id}}</td>
                        <td><a href="{{route('addressType.edit', $at->id)}}">{{$at->name}}</a></td>
                        <td>
                          <form method="post" action="{{route('addressType.destroy', $at->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection
  </x-admin-master>