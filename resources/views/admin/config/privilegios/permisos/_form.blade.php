@if ($permiso->exists)
	<form id="form-permiso" class="form-horizontal form-label-left" action={{ route('permisos.update',  $permiso->id) }} method="POST">
    	{{ method_field('PUT') }}
@else
    <form id="form-permiso" class="form-horizontal form-label-left" action={{ route('permisos.store') }} method="POST">
@endif
    {{ csrf_field() }}
    	<div class="row">
    		<div class="col-12">
    			<div class="form-group">
	                <label for="slug">Nombre</label>
	                <input type="text" id="slug" name="name" class="form-control" value="{{old("name", $permiso->name)}}" required>
	                <small class="form-text text-muted">Inserte un nombre para el permiso</small>
	            </div>

	            <div class="form-group">
	                <label for="nombre_permiso">Nombre para mostrar</label>
	                <input type="text" id="nombre_permiso" name="display_name" class="form-control" value="{{old("display_name", $permiso->display_name)}}" required>
	                <small class="form-text text-muted">Inserte un nombre para el permiso</small>
	            </div>

	            <div class="form-group">
	                <label for="descripcion_permiso">Descripcion</label>
	                <input type="text" id="descripcion_permiso" name="description" class="form-control" value="{{old("description", $permiso->description)}}" required>
	                <small class="form-text text-muted">Inserte una descripción para el permiso</small>
	            </div>
    		</div>
    	</div>
    </form>
