@extends('web.layouts.app')

@section('content')
    @include('web.partials._header')
    <!-- Page Content -->
    <div class="container">
        <p class="m-0 text-center text-white">
            {{-- <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Salud" href="salud.html"><img src="{{asset('web/images/icono-salud.png')}}" width="70" class="img-fluid"></a>
    
            <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Gestión Social" href="gestion_social.html"><img src="{{asset('web/images/social-icono.png')}}" width="75" class="img-fluid"></a>
    
            <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Educación" href="Educacion.html"><img src="{{asset('web/images/educacion-icono.png')}}" width="75" class="img-fluid"></a>
    
            <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Cultura" href="Cultura.html"><img src="{{asset('web/images/musica-icono.png')}}" width="75" class="img-fluid"></a>
    
            <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Deportes" href="Deportes.html"><img src="{{asset('web/images/deportes-icono.png')}}" width="75" class="img-fluid"></a> --}}
            @foreach($categorias as $categoria)
                <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="{{$categoria->nombre}}" href="{{url('/categoria/'.$categoria->slug)}}">
                    <img src="{{asset($categoria->icono_url)}}" width="70" class="img-fluid">
                </a>
            @endforeach
        </p>
        <!-- Portfolio Section -->
        <h2 class="m-3">Eventos/Noticias</h2>
    
        <div class="row">
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
                </div>
            </div>
            </div>
            </div>
        </div>
    
        <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('web/images/b30a8a2e813848087c7d22ed7ea0365a.jpg')}}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                <h3>Noticia/Evento 1</h3>
                <p>Titular de la noticia</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('web/images/roadtoamerica1920x1080.jpg')}}" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                <h3>Noticia/Evento 2</h3>
                <p>Titular de la noticia</p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
    
        <div class="container"> 
        <div class="row mt-5">	   
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="#">Titulo</a>
                </h4>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
                </div>
            </div>
            </div>
        </div>
        <!-- /.row -->
        </div>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
            <img class="d-block w-100"  src="{{asset('web/images/b30a8a2e813848087c7d22ed7ea0365a.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100"  src="{{asset('web/images/roadtoamerica1920x1080.jpg')}}" alt="Second slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection

@push('js')
	
@endpush