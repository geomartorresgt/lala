@if ($textura->exists)
<form id="form-textura" class="form-horizontal form-label-left" action="{{ route('texturas.update', $textura->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form-textura" class="form-horizontal form-label-left" action="{{ route('texturas.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}

    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre', $textura->nombre)}}" required>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="archivo">Foto</label>
            <input type="file" id="archivo" name="archivo" class="form-control" value="{{old('archivo', $textura->foto_url)}}" required accept="image/*">
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="tipo">Tipo de Textura</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option> Seleccione Tipo de Textura</option>
                @foreach( $tipoTextura as $key => $tipo)
                    <option value="{{ $key }}" {{ old('tipo', $textura->tipo) == $key ? 'selected': '' }} >{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="tipo">Activo</label><br>
            <label class="switch switch-primary">
                <input type="checkbox" class="switch-input" {{old('activo', $textura->activo)? 'checked': '' }} name="activo" value="1">
                <span class="switch-slider"></span>
            </label>
        </div>
    </div>
</form>
