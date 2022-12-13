<x-admin-master>
    @section('content')
        <h1>Update Product Element</h1>

        @if (Session::has('productElement_update_message'))
          <div class="alert alert-success">{{Session::get('productElement_update_message')}}</div>
        @endif

        <form method="post" action="{{route('product_element.update', [$product->id, $product_item->id, $product_element->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text"
                        name="size"
                        class="form-control"
                        id="size"
                        aria-describedby=""
                        value="{{$product_element->size}}">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text"
                        name="price"
                        class="form-control"
                        id="price"
                        aria-describedby=""
                        value="{{$product_element->price}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('product_item.edit', [$product->id, $product_item->id])}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </form>
    @endsection
</x-admin-master>