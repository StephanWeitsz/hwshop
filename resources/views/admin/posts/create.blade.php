<x-admin-master>
    @section('content')
        <h1>Create Post</h1>
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                        name="title"
                        class="form-control"
                        id="title"
                        aria-describedby=""
                        placeholder="Enter title">
            </div>
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
                            rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="post_image[]">Post Image</label>
                <input type="file"
                        name="post_image[]"
                        class="form-control-file"
                        id="post_image[]"
                        multiple>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>