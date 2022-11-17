<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HW SHOP</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">
</head>

<body>
  
  <x-home.navigation></x-home.navigation>

  <!-- Page Content -->
  <div class="container">
    <x-home.hero></x-home.hero>
    
    @if(request()->is('/'))
      <div class="row">
        <div class="col-md-12">
          <h1 class="my-4">Announcements and Specials
            <small>: Take Note</small>
          </h1>
        </div>
      </div>
    @endif
    
    <div class="row">

      <!-- Main Body Column -->
      <div class="col-md-8">
        <!-- Blog Entries Column -->
        @yield('content')
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Search Widget -->
        <x-home.widget.search></x-home.widget.search>

        <!-- top products Widget -->
        <x-home.widget.product></x-home.widget.product>
        
        <!-- Side Widget -->
        <x-home.widget.side></x-home.widget.side>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>