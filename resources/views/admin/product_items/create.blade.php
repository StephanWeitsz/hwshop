<x-admin-master>
    @section('content')
        <h1>Create Product Item</h1>
        <form method="post" action="{{route('product_item.store', $product->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        aria-describedby=""
                        placeholder="Enter product item name">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about"
                            class="form-control"
                            id="about"
                            cols="30"
                            rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>