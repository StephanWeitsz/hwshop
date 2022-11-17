<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">Posts
              <span class="sr-only">{{ (request()->is('/')) ? ' (current) ' : '' }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
                <span class="sr-only">{{ (request()->is('about')) ? ' (current) ' : '' }}</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Products</a>
                <span class="sr-only">{{ (request()->is('Product')) ? ' (current) ' : '' }}</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
                <span class="sr-only">{{ (request()->is('Orders')) ? ' (current) ' : '' }}</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
                <span class="sr-only">{{ (request()->is('Contacts')) ? ' (current) ' : '' }}</span>
          </li>

          @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
            </li> 
            <li class="nav-item">
              <form action="/logout" method="post">
                @csrf
                <button class="btn btn-danger">Logout</button>
              </form>
            </li> 
          @else
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>    
          @endif 
        </ul>
      </div>
    </div>
  </nav>