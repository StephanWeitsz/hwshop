<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-table"></i>
      <span>Products</span>
  </a>
  <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Products</h6>
        <a class="collapse-item" href="{{route('product.create')}}">Create a Product</a>
        <a class="collapse-item" href="{{route('product.index')}}">View All Products</a>
    </div>
  </div>
</li>