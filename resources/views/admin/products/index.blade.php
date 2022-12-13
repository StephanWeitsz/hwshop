<x-admin-master>
    @section('content')
        <h1>All Products</h1>

        @if (Session::has('product_delete_message'))
            <div class="alert alert-danger">{{Session::get('product_delete_message')}}</div>
        @elseif (Session::has('product_create_message'))
            <div class="alert alert-success">{{Session::get('product_create_message')}}</div>
        @elseif (Session::has('product_update_message'))
            <div class="alert alert-success">{{Session::get('product_update_message')}}</div>
        @else
            
        @endif

        @if (Session::has('product_image_update_message'))
          <div class="alert alert-success">{{Session::get('product_image_update_message')}}</div>
        @else
            
        @endif

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">HW SHOP - PRODUCTS</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                      <td>
                        @if ($product->images)
                          @foreach($product->images as $image)
                            <img height="50px" src="{{$image->filename}}" class="rounded float-left" alt="...">
                            @break;
                          @endforeach                           
                        @else
                            <img height="50px" src="..." class="rounded float-left" alt="...">
                        @endif
                      </td>
                      <td>
                        <a href="{{route('product.edit', $product->id)}}">{{$product->name}}</a>
                      </td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->created_at->diffForHumans()}}</td>
                      <td>{{$product->updated_at->diffForHumans()}}</td>
                      <td>
                        {{--@can('delete', $product)--}}
                          <form method="post" action="{{route('product.destroy', $product->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        {{--@endcan--}}
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
            {{--$products->links()--}}
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