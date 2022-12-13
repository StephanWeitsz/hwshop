<x-admin-master>
    @section('content')
        <h1>Edit Product</h1>

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
        @elseif (Session::has('productItem_create_message'))
          <div class="alert alert-success">{{Session::get('productItem_create_message')}}</div>
        @elseif (Session::has('productItem_delete_message'))
        <div class="alert alert-danger">{{Session::get('productItem_delete_message')}}</div>
        @else
        
        @endif
        

        <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        aria-describedby=""
                        value="{{$product->name}}">
            </div>

            <div class="form-group">
                <label for="name">Type</label>
                <input type="text"
                        name="type"
                        class="form-control"
                        id="type"
                        aria-describedby=""
                        value="{{$product->type}}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                            class="form-control"
                            id="description"
                            cols="30"
                            rows="6">{{$product->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="product_image[]">Product Images</label>
                <input type="file"
                        name="product_image[]"
                        class="form-control-file"
                        id="product_image[]"
                        multiple>
            </div>

            @if($product->images)
                <div class="row">
                    @foreach($product->images as $image)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img
                                src="{{asset($image->filename)}}"
                                class="w-50 shadow-1-strong mb-4"
                                alt=""
                            />
                        </div>
                    @endforeach
                </div>
            @endif
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('product.index')}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </form>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Items</h6>

                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="{{route('product_item.create', $product->id)}}" class="btn btn-secondary" role="button" aria-disabled="true">New Product</a>
                            <div>
                        <div>
                    </div>
                </div>
            </div>     
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>About</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>About</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($product->product_item as $item)
                                        <tr>
                                            <td>
                                                <a href="{{route('product_item.edit', [$product->id, $item->id])}}">{{$item->name}}</a>
                                            </td>
                                            <td>{{$item->about}}</td>
                                            <td>
                                                <form method="post" action="{{route('product_item.destroy', [$product->id, $item->id])}}">
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
        <br>
    @endsection
</x-admin-master>