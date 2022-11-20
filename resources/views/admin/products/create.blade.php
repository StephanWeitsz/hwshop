<x-admin-master>
    @section('content')
        <h1>Create Product</h1>
        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        aria-describedby=""
                        placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                            class="form-control"
                            id="description"
                            cols="30"
                            rows="20"></textarea>
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about"
                            class="form-control"
                            id="about"
                            cols="30"
                            rows="15">About this product</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text"
                       name="price"
                       class="form-control"
                       id="price"
                       aria-describedby=""
                       placeholder="Enter product price">
            </div>

            <div class="form-group">
                <label for="product_image[]">Product Images</label>
                <input type="file"
                        name="pproduct_image[]"
                        class="form-control-file"
                        id="product_image[]"
                        multiple>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>