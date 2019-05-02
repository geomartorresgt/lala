@if ($mueble->exists)
<form id="form-mueble" class="form-horizontal form-label-left" action="{{ route('muebles.update', $mueble->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form-mueble" class="form-horizontal form-label-left" action="{{ route('muebles.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}

    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre', $mueble->nombre)}}" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="directorio_url">Directorio</label>
            <input type="file" id="directorio_url" name="directorio_url" class="form-control" value="{{old('directorio_url', $mueble->directorio_url)}}" required  accept="application/zip">
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="foto_url">Foto</label>
            <input type="file" id="foto_url" name="foto_url" class="form-control" value="{{old('foto_url', $mueble->foto_url)}}" required accept="image/*">
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="dimensiones">Dimensiones</label>
            <input type="text" id="dimensiones" name="dimensiones" class="form-control" value="{{old('dimensiones', $mueble->dimensiones)}}" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="categoria_mueble_id">Categoría</label>
            <select class="form-control" id="categoria_mueble_id" name="categoria_mueble_id" required>
                <option> Seleccione la Categoría</option>
                @foreach (App\Models\CategoriaMueble::all() as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_mueble_id', $mueble->categoria_mueble_id) == $categoria->id ? 'selected': '' }} >{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="categoria_mueble_id">Orden</label>
            <select class="form-control" id="orden" name="orden" required>
                <option> Seleccione Orden</option>
                @foreach (["1","2","3","7","8","9"] as $orden)
                    <option value="{{ $orden }}" {{ old('orden', $mueble->orden) == $orden ? 'selected': '' }} >{{ $orden }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="precio">Precio</label>
            <input type="text" id="precio" name="precio" class="form-control" value="{{old('precio', $mueble->precio)}}" required>
        </div>
    </div>
	

</form>