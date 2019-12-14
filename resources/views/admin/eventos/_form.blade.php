@if ($evento->exists)
<form id="form_evento" class="form-horizontal form-label-left" action={{ route('eventos.update',  $evento->id) }} method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form_evento" class="form-horizontal form-label-left" action={{ route('eventos.store') }} method="POST" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="banner">Banner:</label>
                <div class="col-md-9">
                    <input id="banner" name="banner" class="form-control" type="text" value='{{old("banner", $evento->banner)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="titulo">Titulo:</label>
                <div class="col-md-9">
                    <input id="titulo" name="titulo" class="form-control" type="text" value='{{old("titulo", $evento->titulo)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="descripcion">descripcion:</label>
                <div class="col-md-9">
                    <textarea name="descripcion" id="" cols="30" class="form-control">{{old("descripcion", $evento->descripcion)}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="fecha">Fecha:</label>
                <div class="col-md-9">
                    <input id="fecha" name="fecha" class="form-control datepicker" type="text" value='{{old("fecha", $evento->fecha)}}' data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                </div>
            </div>
        </div>
    </div>
</form>
