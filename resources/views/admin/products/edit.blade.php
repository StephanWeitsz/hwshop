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
                <label for="description">Description</label>
                <textarea name="description"
                            class="form-control"
                            id="description"
                            cols="30"
                            rows="20">{{$product->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about"
                            class="form-control"
                            id="about"
                            cols="30"
                            rows="15">{{$product->about}}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text"
                       name="price"
                       class="form-control"
                       id="price"
                       aria-describedby=""
                       value="{{$product->price}}">
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
        </form>
    @endsection
</x-admin-master>