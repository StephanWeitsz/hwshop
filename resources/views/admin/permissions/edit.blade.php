<x-admin-master>
    @section('content')
        <div class="row">
            @if (Session::has('permission_delete_message'))
            <div class="alert alert-danger">{{Session::get('permission_delete_message')}}</div>
            @elseif (Session::has('permission_create_message'))
            <div class="alert alert-success">{{Session::get('permission_create_message')}}</div>
            @elseif (Session::has('permission_update_message'))
            <div class="alert alert-success">{{Session::get('permission_update_message')}}</div>
            @else

            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Permission: {{$permission->name}}</h1>

                <form method='post' action="{{route('permission.update', $permission->id)}}">
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
                                value="{{$permission->name}}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('permissions.index')}}" class="btn btn-secondary" permission="button" aria-disabled="true">Back</a>
                </form>
            </div>
        </div>

        <hr class="text-dark bg-dark"/>
        
        <div class="row">
            <div class="col-lg-12">
                @if ($roles->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Role List</h6>
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
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" onclick="return false"
                                                        @foreach ($permission->roles as $permission_role)
                                                            @if ($permission_role->slug == $role->slug)
                                                                checked
                                                            @endif    
                                                        @endforeach
                                                    >
                                                </td>
                                                <td>{{$role->id}}</td>
                                                <td>{{$role->name}}</td>
                                                <td>{{$role->slug}}</td>
                                                <td>
                                                    <form method="post" action="{{route('permission.role.attach', $permission)}}">
                                                        @csrf
                                                        @method('PUT')
                
                                                        <input type="hidden" name="role" value="{{$role->id}}">
                                                        <button 
                                                            type= "submit"
                                                            class="btn btn-primary"
                                                            @if ($permission->roles->contains($role))
                                                                disabled                                 
                                                            @endif
                                                        >
                                                            Attach
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('permission.role.detach', $permission)}}">
                                                        @csrf
                                                        @method('PUT')
                
                                                        <input type="hidden" name="role" value="{{$role->id}}">
                                                        <button 
                                                            type= "submit"
                                                            class="btn btn-danger"
                                                            @if (!$permission->roles->contains($role))
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