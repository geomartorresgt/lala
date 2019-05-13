<nav class="sidebar-nav">
    <ul class="nav">
        {{-- <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
            </a>
        </li> --}}
        {{-- <li class="nav-title">Theme</li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('editor.index') }}">
                <i class="fa fa-edit"></i>
                Editor
            </a>
        </li>
        <!--
        <li class="nav-item">
            <a class="nav-link" href="widgets.html">
                <i class="nav-icon icon-calculator"></i> Ejemplo
                <span class="badge badge-primary">NEW</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categorias-muebles.index') }}">
                <i class="nav-icon icon-calculator"></i> Categorias
            </a>
        </li>
    	-->
        <li class="divider"></li>

        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="fas fa-cog"></i> 
                Configuración
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}" target="_top">
                		<i class="fa fa-users"></i>
                        Usuarios
                    </a>
                </li>
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
    			@permission('categorias_muebles_ver')
	                <li class="nav-item">
	                    <a class="nav-link" href="{{ route('categorias-muebles.index') }}" target="_top">
                            <i class="fas fa-tags"></i>
	                        Categorias Muebles
	                    </a>
	                </li>
        		@endpermission
                @permission('muebles_ver')
	                <li class="nav-item">
	                    <a class="nav-link" href="{{ route('muebles.index') }}" target="_top">
                            <i class="fas fa-couch"></i>
	                        Muebles
	                    </a>
	                </li>
        		@endpermission
            </ul>
        </li>
    </ul>
</nav>