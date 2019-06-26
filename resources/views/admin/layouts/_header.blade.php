<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('root_path') }}">
        {{-- <img class="navbar-brand-full" src="img/brand/logo.svg" width="89" height="25" alt=""> --}}
        {{-- <img class="navbar-brand-minimized" src="img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo"> --}}
        UNIGRES
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
<!--
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>
-->
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                {{-- <span class="badge badge-pill badge-danger">5</span> --}}
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-list"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-location-pin"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link mr-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="b-m-r">
                {{-- <img class="img-avatar" src="img/avatars/6.jpg" alt="admin@bootstrapmaster.com"> --}}
                <i class="fas fa-user"></i>
                <span>
                	{{ auth()->user()->nombre_completo }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Configuración</strong>
                </div>
                <a class="dropdown-item  aside-menu-toggler" href="javascript:void(0)" data-toggle="aside-menu-show" 
                	onclick="document.getElementById('b-m-r').click()" >
                    <i class="fa fa-user"></i> Perfil
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                	onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    Cerrar sesion
                </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>