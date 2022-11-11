<x-admin-master>
    @section('content')
        <div class="row">
            @if (Session::has('role_delete_message'))
            <div class="alert alert-danger">{{Session::get('role_delete_message')}}</div>
            @elseif (Session::has('role_create_message'))
            <div class="alert alert-success">{{Session::get('role_create_message')}}</div>
            @elseif (Session::has('role_update_message'))
            <div class="alert alert-success">{{Session::get('role_update_message')}}</div>
            @else

            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Role: {{$role->name}}</h1>

                <form method='post' action="{{route('role.update', $role->id)}}">
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
                                value="{{$role->name}}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('roles.index')}}" class="btn btn-secondary" role="button" aria-disabled="true">Back</a>
                </form>
            </div>
        </div>

        <hr class="text-dark bg-dark"/>
        
        <div class="row">
            <div class="col-lg-12">
                @if ($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permission List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attatch</th>
                                            <th>Detatch</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attatch</th>
                                            <th>Detatch</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" onclick="return false"
                                                        @foreach ($role->permissions as $role_permission)
                                                            @if ($role_permission->slug == $permission->slug)
                                                                checked
                                                            @endif    
                                                        @endforeach
                                                    >
                                                </td>
                                                <td>{{$permission->id}}</td>
                                                <td>{{$permission->name}}</td>
                                                <td>{{$permission->slug}}</td>
                                                <td>
                                                    <form method="post" action="{{route('role.permission.attach', $role)}}">
                                                        @csrf
                                                        @method('PUT')
                
                                                        <input type="hidden" name="permission" value="{{$permission->id}}">
                                                        <button 
                                                            type= "submit"
                                                            class="btn btn-primary"
                                                            @if ($role->permissions->contains($permission))
                                                                disabled                                 
                                                            @endif
                                                        >
                                                            Attach
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('role.permission.detach', $role)}}">
                                                        @csrf
                                                        @method('PUT')
                
                                                        <input type="hidden" name="permission" value="{{$permission->id}}">
                                                        <button 
                                                            type= "submit"
                                                            class="btn btn-danger"
                                                            @if (!$role->permissions->contains($permission))
                                                                disabled                                 
                                                            @endif
                                                        >
                                                            Detach
                                                        </button>
                                                    </form>
                                                </td> 
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>    
                @endif
            </div>
        </div>
    @endsection
</x-admin-master>