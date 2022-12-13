<x-admin-master>
    @section('content')
        <h1>Update Product Item</h1>

        @if (Session::has('productItem_update_message'))
          <div class="alert alert-success">{{Session::get('productItem_update_message')}}</div>
        @elseif (Session::has('productElement_delete_message'))
          <div class="alert alert-success">{{Session::get('productElement_delete_message')}}</div>
        @endif

        <form method="post" action="{{route('product_item.update', [$product->id, $product_item->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        aria-describedby=""
                        value="{{$product_item->name}}">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about"
                            class="form-control"
                            id="about"
                            cols="30"
                            rows="5">{{$product_item->about}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('product.edit', $product->id)}}" class="btn btn-secondary" role="button" aria-disabled="true">Exit</a>
        </form>
            
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Elements</h6>

                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="{{route('product_element.create', [$product->id, $product_item->id])}}" class="btn btn-secondary" role="button" aria-disabled="true">New Element</a>
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
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Remove</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($product_item->product_item_element as $element)
                                        <tr>
                                            <td>
                                                <a href="{{route('product_element.edit', [$product->id, $product_item->id, $element->id])}}">{{$element->size}}</a>
                                            </td>
                                            <td>{{$element->price}}</td>
                                            <td>
                                                <form method="post" action="{{route('product_element.destroy', [$product->id, $product_item->id, $element->id])}}">
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