@if ($categoriaMueble->exists)
<form id="form-categoriamueble" class="form-horizontal form-label-left" action="{{ route('categorias-muebles.update', $categoriaMueble->id) }}" method="POST">
    	{{ method_field('PUT') }}
@else
<form id="form-categoriamueble" class="form-horizontal form-label-left" action="{{ route('categorias-muebles.store') }}" method="POST">
@endif
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="form-control col-12 col-md-6" 
        		value="{{ old('nombre', $categoriaMueble->nombre) }}" required>
    </div>
	

</form>