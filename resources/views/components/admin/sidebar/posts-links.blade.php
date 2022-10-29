<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePosts" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Posts</span>
  </a>
  <div id="collapsePosts" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Posts</h6>
        <a class="collapse-item active" href="{{route('post.create')}}">Create a Post</a>
        <a class="collapse-item" href="{{route('post.index')}}">View My Posts</a>
        
        @if (auth()->user()->userHasRole('Admin'))
          <a class="collapse-item" href="{{route('post.all')}}">View All Posts</a>
        @endif  
    </div>
  </div>
</li>