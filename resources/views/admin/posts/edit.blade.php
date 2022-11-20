<x-admin-master>
    @section('content')
        <h1>Edit Post</h1>

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
        
        <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                        name="title"
                        class="form-control"
                        id="title"
                        aria-describedby=""
                        placeholder="Enter title"
                        value="{{$post->title}}">
            </div>

            <div><img height="100px" src="{{$post->post_banner}}" alt=""></div>

            <div class="form-group">
                <label for="post_banner">Post Banner</label>
                <input type="file"
                        name="post_banner"
                        class="form-control-file"
                        id="post_banner">
            </div>

            <div class="form-group">
                <label for="product">Link to a product (optional)</label>
                <select name="product"
                        class="form-control"
                        id="product"
                        aria-describedby="">
    
                    <option value="0">All Products</option>    
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach       
                </select>
            </div>

            <div class="form-group">
                <textarea name="body"
                          class="form-control"
                          id="body"
                          cols="30"
                          rows="10">{{$post->body}}</textarea>
            </div>

            <div class="form-group">
                <label for="post_image[]">Post Image</label>
                <input type="file"
                        name="post_image[]"
                        class="form-control-file"
                        id="post_image[]"
                        multiple>
            </div>

            @if($post->images)
                <div class="row">
                    @foreach($post->images as $image)
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