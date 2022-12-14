<x-admin-master>
    @section('content')
        <h1>All Posts</h1>

        @if (Session::has('post_delete_message'))
            <div class="alert alert-danger">{{Session::get('post_delete_message')}}</div>
        @elseif (Session::has('post_create_message'))
            <div class="alert alert-success">{{Session::get('post_create_message')}}</div>
        @elseif (Session::has('post_update_message'))
            <div class="alert alert-success">{{Session::get('post_update_message')}}</div>
        @else
            
        @endif

        @if (Session::has('post_image_update_message'))
          <div class="alert alert-success">{{Session::get('post_image_update_message')}}</div>
        @else
            
        @endif

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">HW SHOP - POSTS</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Owner</th>
                    <th>Product</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Owner</th>
                    <th>Product</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($posts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>
                        @if ($post->user)
                          {{$post->user->name}}
                        @else
                          DELETED
                        @endif
                      </td>
                      <td>
                        @if($post->product)
                          {{$post->product->name}}
                        @else
                          All Products
                        @endif
                      </td>
                      <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                      <td>
                        <img height="50px" src="{{$post->post_banner}}" alt="">
                      </td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                      <td>
                        @can('delete', $post)
                          <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="d-flex">
          <div class="mx-auto">
            {{--$posts->links()--}}
          </div>      
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