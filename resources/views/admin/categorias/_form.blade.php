@if ($categoria->exists)
<form id="form_categoria" class="form-horizontal form-label-left" action={{ route('categorias.update',  $categoria->id) }} method="POST">
    {{ method_field('PUT') }}
@else
<form id="form_categoria" class="form-horizontal form-label-left" action={{ route('categorias.store') }} method="POST">
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
    </div>
</form>
