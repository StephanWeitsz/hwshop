<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Orders</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Orders</h6>
        <a class="collapse-item" href="{{route('order.create')}}">Create a Order</a>
        <a class="collapse-item" href="{{route('order.index')}}">View All Orders</a>
        <a class="collapse-item" href="{{route('order.new')}}">View New Orders</a>
        <a class="collapse-item" href="{{route('order.inprogress')}}">View Inprogress Orders</a>
        <a class="collapse-item" href="{{route('order.onhold')}}">View Onhold Orders</a>
        <a class="collapse-item" href="{{route('order.closed')}}">View Closed Orders</a>

    </div>
  </div>
</li>