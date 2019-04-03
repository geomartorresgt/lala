<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>..:: Unigres ::..</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/coreui-icons.min.css">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/coreui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/cropit.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    @stack('css')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('admin.layouts._header')

    <div class="app-body">
        <div class="sidebar">
            @include('admin.layouts._nav')

            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
        <main class="main">
        	@yield('content-editor')

            <div class="container-fluid">
                <div class="animated fadeIn">
                	@include('flash::message')
                	@if (count($errors) > 0)
	                    @include('partials.errors')
	                @endif
                	@yield('content')
                </div>
            </div>
        </main>

		<!-- menu lateral derecho -->
        @include('admin.layouts._menu_derecho')
        @include('admin.layouts._modal_cambiar_foto')
    </div>
    <footer class="app-footer">
        <div>
            <a href="https://coreui.io">CoreUI</a>
            <span>&copy; 2018 creativeLabs.</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="https://coreui.io">CoreUI</a>
        </div>
    </footer>

    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/coreui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.cropit.js')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');

		$('div.alert').not('.alert-important').delay(10000).fadeOut(950);

    </script>

    @stack('js')
</body>

</html>
