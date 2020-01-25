<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fundación LALA</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('web/bootstrap/css/bootstrap.min.css')}}">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('web/css/modern-business.css')}}">

    <style>
      video{
        width: 100%;
        max-height: 550px; 
      }
    </style> 
    @stack('css')
  </head>
  <body>
    @include('web.partials._nav')
    
    {{-- contenido principal de la página --}}
    @yield('content')

	  @include('web.partials._footer')

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('web/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>

    @stack('js')
  </body>
</html>
