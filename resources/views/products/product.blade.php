<x-product-master>

    @if($product->images)
        @section('images')
            @php
                $image_count = count($product->images);
            @endphp

            <div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
                <div class="row py-3 shadow-5">
                    <div class="col-12 mb-1">
                        <div class="lightbox">
                            @foreach ($product->images as $image)
                                <img
                                    src="{{$image->filename}}"
                                    alt="Gallery image 1"
                                    class="ecommerce-gallery-main-img active w-100"
                                />
                                @break
                            @endforeach
                        </div>
                    </div>

                    @if ($image_count > 1)
                        @php $product_ctr = 0; @endphp
                        @foreach ($product->images as $image)
                            @php $product_ctr++; @endphp
                            <div class="col-3 mt-1">
                                <img
                                    src="{{$image->filename}}"
                                    data-mdb-img="{{$image->filename}}"
                                    alt="Gallery image {{$product_ctr}}"
                                    class="
                                        @if($product_ctr == 1)
                                            active
                                        @endif
                                        w-100"
                                />
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endsection
    @endif

    @section('content')
        <div class="row py-3 shadow-5">
            <div class="col-12 mb-1">
                <h1>{{$product->name}}</h1>
                <hr>
                <a href="{{route('products')}}">back to products</a>
                <hr>
                <h2>Product Description</h2>
                <p>{{$product->description}}</p>

                @if($product->type)
                    <p><strong>{{$product->type}}</strong></p> 
                @endif

                @foreach($product->product_item as $item)
                    <hr>    
                    <h2>{{$item->name}}</h2>
                    <p>{{$item->about}}</p>
                    
                    @foreach($item->product_item_element as $element)
                        {{$element->size}} : {{$element->price}}<br>       
                    @endforeach
                @endforeach
            </div>
        </div>        
    @endsection
</x-product-master>