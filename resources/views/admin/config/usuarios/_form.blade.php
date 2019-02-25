@if ($usuario->exists)
	<form id="form-usuario" class="form-horizontal form-label-left" action={{ route('usuarios.update',  $usuario->id) }} method="POST">
    	{{ method_field('PUT') }}
@else
    <form id="form-usuario" class="form-horizontal form-label-left" action={{ route('usuarios.store') }} method="POST">
@endif
    {{ csrf_field() }}
    	<div class="row">
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="nombres">Nombres:</label>
    	            <div class="col-md-9">
    	                <input id="nombres" name="nombres" class="form-control" type="text" value='{{old("nombres", $usuario->nombres)}}'>
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="apellidos">Apellidos:</label>
    	            <div class="col-md-9">
    	                <input id="apellidos" name="apellidos" class="form-control" type="text" value='{{old("apellidos", $usuario->apellidos)}}'>
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="email">E-mail:</label>
    	            <div class="col-md-9">
    	                <input id="email" name="email" class="form-control" type="email" value='{{old("email", $usuario->email)}}'>
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="telefono">Teléfono:</label>
    	            <div class="col-md-9">
    	                <input id="telefono" name="telefono" class="form-control" type="text" value='{{old("telefono", $usuario->telefono)}}'>
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="rol">Rol:</label>
    	            <div class="col-md-9">
    	                <select id="rol" name="rol" class="form-control">
    	                    <option>-Seleccione</option>
    	                    @foreach($roles as $rol)
    	                    	

    	                    	@if ($usuario->exists)
    	                    		<option value="{{ $rol->id }}" @if($rol->id==old("rol", $usuario->roles->first()->id) ) selected @endif>{{$rol->display_name}}</option>
    	                    	@else
    	                    		<option value="{{ $rol->id }}" @if($rol->id==old("rol") ) selected @endif>{{$rol->display_name}}</option>
    	                    	
    	                    	@endif
    	                    @endforeach
    	                </select>
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-3 control-label" for="password">Contraseña:</label>
    	            <div class="col-md-9">
    	                <input id="password" name="password" class="form-control" type="password">
    	            </div>
    	        </div>
    	    </div>
    	    <div class="col-md-6">
    	        <div class="form-group">
    	            <label class="col-md-9 control-label" for="repClave">Repetir Contraseña:</label>
    	            <div class="col-md-9">
    	                <input id="repClave" name="repClave" class="form-control" type="password">
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </form>
