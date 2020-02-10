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
                <label class="col-md-12 control-label font-weight-bold" for="titulo">Titulo:</label>
                <div class="col-md-9">
                    <input id="titulo" name="titulo" class="form-control" type="text" value='{{old("titulo", $evento->titulo)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-12 control-label font-weight-bold" for="banner">Banner:</label>
                <div class="col-md-12">
                    <input id="banner" name="banner" class="form-control" type="file" value='{{old("banner", $evento->banner)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label font-weight-bold" for="fecha">Fecha:</label>
                <div class="col-md-9">
                    <input id="fecha" name="fecha" class="form-control datepicker" type="text" value='{{old("fecha", $evento->fecha)}}' data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                </div>
            </div>
        </div>
        @if ($evento->exists)
            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-md-12 control-label font-weight-bold" for="banner">Publicado:</label>
                    <div class="col-md-12">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="publicado" class="switch-input" {{ $evento->publicado? 'checked': null }} >
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="col-md-12 control-label font-weight-bold" for="destacado">Destacado:</label>
                    <div class="col-md-12">
                        <label class="switch switch-primary">
                            <input type="checkbox" name="destacado" class="switch-input" {{ $evento->destacado? 'checked': null }} >
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
                <label class="col-md-12 control-label font-weight-bold" for="descripcion">Descripción:</label>
                <div class="col-md-12">
                    <textarea name="descripcion" id="" cols="30" rows="5" class="form-control ckeditor">{{old("descripcion", $evento->descripcion)}}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="col-md-12">Categorías</h4>
        </div>
        @foreach ($categorias as $categoria)
            <div class="col-md-2">
                <div class="container">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold text-right" for="categoria-{{$categoria->id}}">{{$categoria->nombre}}</label>
                        <div class="col-md-7">
                            <label class="switch switch-primary">
                                <input type="checkbox" name="categorias[]" id="categoria-{{$categoria->id}}" class="switch-input" value="{{$categoria->id}}" {{ $evento->tieneCategoria($categoria->id)? 'checked':'' }}>
                                <span class="switch-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</form>
