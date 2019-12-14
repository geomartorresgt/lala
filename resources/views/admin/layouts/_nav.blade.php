<nav class="sidebar-nav">
    <ul class="nav">
        @permission('usuarios_ver')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categorias.index') }}">
                <i class="fas fa-tags"></i>
                Categorías
            </a>
        </li>
        @endpermission
        @permission('usuarios_ver')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('eventos.index') }}">
                <i class="fas fa-calendar"></i>
                Eventos
            </a>
        </li>
        @endpermission
        @permission('usuarios_ver')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('publicaciones.index') }}">
                <i class="fas fa-book"></i>
                Publicaciones
            </a>
        </li>
        @endpermission
        @permission('usuarios_ver')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('preguntas-frecuentes.index') }}">
                <i class="fas fa-question"></i>
                Preguntas Frecuentes
            </a>
        </li>
        @endpermission

        <li class="divider"></li>

        @permission(['usuarios_ver','privilegios_ver',])
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fas fa-cog"></i> 
                Configuración
            </a>
            <ul class="nav-dropdown-items">
                @permission('usuarios_ver')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}" target="_top">
                		<i class="fa fa-users"></i>
                        Usuarios
                    </a>
                </li>
                @endpermission
    			@permission('privilegios_ver')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-check-double"></i>
                        Privilegios
                    </a>
                    <ul class="nav-dropdown-items">
                    	<li class="nav-item">
                    	    <a class="nav-link" href="{{ route('roles.index') }}" target="_top">
                    	        <i class="nav-icon icon-star"></i> Roles
                    	    </a>
                    	</li>
                    	<li class="nav-item">
                    	    <a class="nav-link" href="{{ route('permisos.index') }}" target="_top">
                    	        <i class="nav-icon icon-star"></i> Permisos
                    	    </a>
                    	</li>
                    </ul>
                </li>
        		@endpermission
            </ul>
        </li>
        @endpermission
    </ul>
</nav>
