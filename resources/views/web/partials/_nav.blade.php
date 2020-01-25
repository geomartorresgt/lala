<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('root_path')}}">
            <img class="img-fluid" src="{{asset('web/images/Fundación.png')}}" width="140" alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right bg-primary" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('web.conocenos') }}"> <Strong>Conócenos</Strong></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><Strong>¿Qué hacemos?</Strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right bg-success" aria-labelledby="navbarDropdownPortfolio">
                      <a class="dropdown-item" href="salud.html">Salud</a>
                      <a class="dropdown-item" href="gestion_social.html">Gestión social</a>
                      <a class="dropdown-item" href="Educacion.html">Educación</a>
                      <a class="dropdown-item" href="Cultura.html">Cultura</a>
                      <a class="dropdown-item" href="Deportes.html">Deportes</a>
                    </div>
                  </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#"><Strong> Aliados</Strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{route('web.eventos.index')}}"><Strong> Eventos</Strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{route('web.preguntasFrecuentes.index')}}"><Strong> Preguntas Frecuentes</Strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="#"><Strong>Artículos de interés</Strong></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <Strong>Contactos</Strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right bg-success" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="#">Centro pediatrico</a>
                        <a class="dropdown-item" href="#">Fundación LALA</a>
                        <a class="dropdown-item" href="#">Academia de música</a>
                        <a class="dropdown-item" href="#">Academia deportiva</a>
                        <a class="dropdown-item" href="#">Escuela de inglés</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>