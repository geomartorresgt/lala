<nav class="sidebar-nav">
    <ul class="nav">
        {{-- <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
            </a>
        </li> --}}
        {{-- <li class="nav-title">Theme</li> --}}

        {{-- 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('editor.index') }}">
                <i class="fa fa-edit"></i>
                Editor
            </a>
        </li>
        --}}
        @permission('presupuestos_ver')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('presupuestos.index') }}">
                <i class="fas fa-clipboard-list"></i>
                Presupuestos
            </a>
        </li>
        @endpermission
        @permission('mis_presupuestos_crear')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('presupuestos.misPresupuestos') }}">
                <i class="fas fa-clipboard-list"></i>
                Mis Presupuestos
            </a>
        </li>
        @endpermission
        @permission('local_mueble_ver')
            @if( auth()->user()->local_id )
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('localMueble.index') }}" target="_top">
                        <i class="fas fa-couch"></i>
                        Muebles
                    </a>
                </li>
            @endif
        @endpermission

        <li class="divider"></li>

        @permission(['usuarios_ver','privilegios_ver', 'categorias_muebles_ver', 'muebles_ver' ])        
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
        @endpermission
    </ul>
</nav>
