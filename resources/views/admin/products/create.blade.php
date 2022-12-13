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
                <label for="name">Type</label>
                <input type="text"
                        name="type"
                        class="form-control"
                        id="type"
                        aria-describedby=""
                        placeholder="Enter product type">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description"
                            class="form-control"
                            id="description"
                            cols="30"
                            rows="6"></textarea>
            </div>

            <div class="form-group">
                <label for="product_image[]">Product Images</label>
                <input type="file"
                        name="product_image[]"
                        class="form-control-file"
                        id="product_image[]"
                        multiple>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>