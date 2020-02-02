@if ($categoria->exists)
<form id="form_categoria" class="form-horizontal form-label-left" action={{ route('categorias.update',  $categoria->id) }} method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form_categoria" class="form-horizontal form-label-left" action={{ route('categorias.store') }} method="POST" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="pregunta">Nombre:</label>
                <div class="col-md-9">
                    <input id="nombre" name="nombre" class="form-control" type="text" value='{{old("nombre", $categoria->nombre)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="clave">Clave:</label>
                <div class="col-md-9">
                    <input id="clave" name="clave" class="form-control" type="text" value='{{old("clave", $categoria->clave)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="icono">Icono:</label>
                <div class="col-md-9">
                    <input id="icono" name="icono" class="form-control" type="file" value='{{old("icono", $categoria->icono)}}'>
                </div>
            </div>
        </div>
        @if ($categoria->exists)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-12 control-label font-weight-bold" for="inicio">Mostrar en Inicio:</label>
                    <div class="col-md-12">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="inicio" class="switch-input" {{ $categoria->inicio? 'checked': null }} >
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-12 control-label" for="descripcion">Descripción:</label>
                <div class="col-md-12">
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control ckeditor">{{old("descripcion", $categoria->descripcion)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>
