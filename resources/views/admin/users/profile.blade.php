<x-admin-master>
    @section('content')
        <h1>User Profile for : {{$user->name}}</h1>    
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img class="img-profile rounded-circle" src="{{$user->avatar}}" width="150" height="150">
                    </div>
                    <div class="form-group">
                        <label for="file">Add Avatar Image</label>
                        <input type="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control 
                                @error('username')
                                    is-invalid
                                @enderror"
                               id="username"
                               value="{{$user->username}}"
                        >
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control 
                                @error('name')
                                    is-invalid
                                @enderror"
                               id="name"
                               value="{{$user->name}}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               class="form-control
                                @error('name')
                                    is-invalid
                                @enderror"
                               id="email"
                               value="{{$user->email}}"
                        >
                        @error('email')
                            <div class="allert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <!--Show Address...-->
                    <div class="form-group">
                        <label for="Addresss">Addresses</label>
                        @if ($user->address->isNotEmpty())
                            @foreach($user->address as $ua)
                                <div class="form-group">                       
                                    <label for="Addresss{{$ua->addresstype->name}}">{{$ua->addresstype->name}}</label>
                                    <textarea
                                        class="form-control" 
                                        cols=80%
                                        rows="5" 
                                        name="Address{{$ua->addresstype->name}}" 
                                        id="Address{{$ua->addresstype->name}}"
                                        readonly>{{$ua->line1}}
{{$ua->line2}}
@if($ua->line3)
{{$ua->line3}}
@endif
@if($ua->line4)
{{$ua->line4}}
@endif
{{$ua->postalcode}}</textarea>
                                </div>
                            @endforeach  
                        @else
                           <p><strong>No Address Captured</strong></p>
                        @endif
                        <a href="{{route('address.index', $user)}}" class="btn btn-secondary" role="button" aria-disabled="true">Addresses</a>
                    </div>
                    <!--Add Contact Numbers...-->
                    <div class="form-group">
                        <label for="Contact">Contact Numbers</label>
                        @if ($user->contact->isNotEmpty())
                            @foreach($user->contact as $uc)
                                <div class="form-group">
                                    <label for="Contact{{$uc->contacttype->name}}">{{$uc->contacttype->name}}</label>
                                    <input type="text"
                                        name="Contact{{$uc->contacttype->name}}"
                                        class="form-control"
                                        id="Contact{{$uc->contacttype->name}}"
                                        value="{{$uc->number}}"
                                        readonly
                                    >
                                </div>
                            @endforeach
                        @else
                            <p><strong>No Contact Numbers Captured</strong></p> 
                        @endif    
                        <a href="{{route('contact.index', $user)}}" class="btn btn-secondary" role="button" aria-disabled="true">Contact</a>
                    </div>
                    <div class="form-group">
                        <label for="note">Admin Note</label>
                        <textarea
                            class="form-control {{$errors->has('note') ? 'is-invalid' : ''}}" 
                            cols=80% 
                            rows="10" 
                            name="note" 
                            id="note">{{$user->note}}
                        </textarea> 
                        @error('note')
                            <div class="allert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <hr class="text-dark bg-dark"/>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password"
                        >
                        @error('password')
                            <div class="allert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               id="password-confirmation"
                        >
                        @error('password_confirmation')
                            <div class="allert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('users.index')}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>   
                </form>
            </div>
        </div>
        <hr class="text-dark bg-dark"/>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                            @foreach($roles as $role)
                              <tr>
                                <td><input type="checkbox" onclick="return false"
                                        @foreach ($user->roles as $user_role)
                                            @if ($user_role->slug == $role->slug)
                                                checked
                                            @endif    
                                        @endforeach
                                    >
                                </td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="post" action="{{route('user.role.attach', $user)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button 
                                            type= "submit"
                                            class="btn btn-primary"
                                            @if ($user->roles->contains($role))
                                                disabled                                 
                                            @endif
                                        >Attach
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{route('user.role.detach',$user)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button
                                            type= "submit"
                                            class="btn btn-danger"
                                            @if (!$user->roles->contains($role))
                                                disabled                                 
                                            @endif
                                        >Detach
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
            </div>
        </div>
    @endsection
</x-admin-master>