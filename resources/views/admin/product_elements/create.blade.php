<x-admin-master>
    @section('content')
        <h1>Create Product Element</h1>
        <form method="post" action="{{route('product_element.store', [$product->id, $product_item])}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text"
                        name="size"
                        class="form-control"
                        id="size"
                        aria-describedby=""
                        placeholder="Enter product element size">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text"
                        name="price"
                        class="form-control"
                        id="price"
                        aria-describedby=""
                        placeholder="Enter product element price">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>