<x-product-master>
    @section('content')
        <div class="row py-3 shadow-5">
            <div class="col-12 mb-1">
                <h1>{{$item->name}}</h1>
                <hr>
                <a href="{{route('product', $product->id)}}">back to product {{$product->name}}</a>
                <hr>
                <h2>Product Description</h2>
                <p>{{$product->name}}</p>
                @if($product->type)
                    <p><strong>{{$product->type}}</strong></p> 
                @endif
                <p>{{$product->description}}</p>
                <hr>
                <h2>{{$item->name}}</h2>
                <p>{{$item->about}}</p>
                   
                @foreach($item->product_item_element as $element)
                    {{$element->size}} : {{$element->price}}<br>       
                @endforeach
            </div>
        </div>        
    @endsection
</x-product-master>