<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
            </a>
        </li>
        <li class="nav-title">Theme</li>
        
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
        <li class="divider"></li>

        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-star"></i> Configuración
            </a>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usuarios.index') }}" target="_top">
                        <i class="nav-icon icon-star"></i>Usuarios
                    </a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-star"></i> Privilegios
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
            </ul>
        </li>
    </ul>
</nav>
