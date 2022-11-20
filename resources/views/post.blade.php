<x-home-master>
  @section('content')
    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>

    <!-- Author -->
    @if ($post->user)
      <p class="lead">
        by
        <a href="#">{{$post->user->name}}</a>
      </p>
    @else
      <p class="lead">
        by <b>DELETED USER : {{$post->user_id}}
      </p>
    @endif 

    <hr>
      
    <!-- Date/Time -->
    <p>Posted on {{$post->created_at->diffForHumans()}}</p>
      
    <hr>
      
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{$post->post_banner}}" alt="">
      
    <hr>
      @if($post->product_id)
        <p> This post is related to the product : <strong>{{$post->product->name}}</strong></p>
      @else
        <p> This post is related to the <strong>ALL</strong> products</p>
      @endif
    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>

    <hr>

    @if($post->images)
      <div class="row">
        @foreach($post->images as $image)
          <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img
              src="{{asset($image->filename)}}"
              class="w-50 shadow-1-strong rounded mb-4"
              alt=""
            />
          </div>
        @endforeach
      </div>
    @endif
    
    <hr>
      
    <!-- Comments Form -->
    <div class="card my-4">
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
        <form>
          <div class="form-group">
            <textarea class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
      
    <!-- Single Comment -->
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
    </div>
      
    <!-- Comment with nested comments -->
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

        <div class="media mt-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>

        <div class="media mt-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          </div>
        </div>
      </div>
    </div>  
  @endsection
</x-home-master>