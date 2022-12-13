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
    
      <!-- row -->
      <div class="row">
        <!-- Main Body Column -->
        <div class="col-md-4">
          <!-- Product Image Column -->
          @yield('images')
        </div>
        <div class="col-md-8">
          <!-- Product Detail Column -->
          @yield('content')
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    <x-footer-master></x-footer-master>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>