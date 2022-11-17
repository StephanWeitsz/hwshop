<x-admin-master>
    @section('content')
        <h1>Addresses for {{$user->name}}</h1>

        @if (Session::has('address_delete_message'))
            <div class="alert alert-danger">{{Session::get('address_delete_message')}}</div>
        @elseif (Session::has('address_create_message'))
            <div class="alert alert-success">{{Session::get('address_create_message')}}</div>
        @elseif (Session::has('address_update_message'))
            <div class="alert alert-success">{{Session::get('address_update_message')}}</div>    
        @else
            
        @endif

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Addresses</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Geo-Coordinates</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Geo-Coordinates</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($user->address as $address)
                    <tr>
                      <td>{{$address->id}}</td>
                      <td>{{$address->addresstype->name}}</td>
                      <td>
                        <a href="{{route('address.edit', [$uid = $user->id, $ua = $address->id])}}">
                          {{$address->line1}}<br>
                          @if($address->line2)
                              {{$address->line2}}<br>
                          @endif
                          @if($address->line3)
                              {{$address->line3}}<br>
                          @endif
                          @if($address->line4)
                              {{$address->line4}}
                          @endif
                        </a>
                      </td>
                      <td>
                        {{$address->postalcode}}
                      </td>
                      <td>
                        {{$address->lat}} - {{$address->long}}
                      </td>
                      <td>{{$address->created_at}}</td> {{--->diffForHumans()--}}
                      <td>{{$address->updated_at}}</td> {{--->diffForHumans()--}}
                      <td>
                        <form method="post" action="{{route('address.destroy', [$uid = $user->id, $address = $address->id])}}" enctype="multipart/form-data">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>         
        </div>

        <div class="card-body">
          <a href="{{route('address.create', $user->id)}}" class="btn btn-primary">Add Address</a>
          <a href="{{route('user.profile.show', $user->id)}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </div>  
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>