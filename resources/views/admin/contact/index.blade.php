<x-admin-master>
    @section('content')
        <h1>Contact Detail for {{$user->name}}</h1>

        @if (Session::has('contact_delete_message'))
            <div class="alert alert-danger">{{Session::get('contact_delete_message')}}</div>
        @elseif (Session::has('contact_create_message'))
            <div class="alert alert-success">{{Session::get('contact_create_message')}}</div>
        @elseif (Session::has('contact_update_message'))
            <div class="alert alert-success">{{Session::get('contact_update_message')}}</div>    
        @else
            
        @endif

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contacts</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Number</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Number</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($user->contact as $contact)
                    <tr>
                      <td>{{$contact->id}}</td>
                      <td>{{$contact->contacttype->name}}</td>
                      <td>
                        <a href="{{route('contact.edit', [$uid = $user->id, $uc = $contact->id])}}">{{$contact->number}}</a>
                      </td>
                      <td>
                        <form method="post" action="{{route('contact.destroy', [$uid = $user->id, $contact = $contact->id])}}" enctype="multipart/form-data">
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
          <a href="{{route('contact.create', $user->id)}}" class="btn btn-primary">Add Contact Number</a>
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