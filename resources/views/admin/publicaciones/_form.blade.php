@if ($publicacion->exists)
<form id="form_publicacion" class="form-horizontal form-label-left" action={{ route('publicaciones.update',  $publicacion->id) }} method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form_publicacion" class="form-horizontal form-label-left" action={{ route('publicaciones.store') }} method="POST" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-12 control-label" for="titulo">Titulo:</label>
                <div class="col-md-12">
                    <input id="titulo" name="titulo" class="form-control" type="text" value='{{old("titulo", $publicacion->titulo)}}'>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-12 control-label" for="contenido">Contenido:</label>
                <div class="col-md-12">
                    <textarea name="contenido" id="" cols="30" rows="5" class="form-control ckeditor">{{old("contenido", $publicacion->contenido)}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h4>Categorías</h4>
        </div>
        @foreach ($categorias as $categoria)
            <div class="col-md-3">
                <input name="categorias[]" class="" type="checkbox" value='{{$categoria->id}}' {{ $publicacion->tieneCategoria($categoria->id)? 'checked':'' }} >
                <label for="categorias">{{$categoria->nombre}}</label>
            </div>
        @endforeach
    </div>
</form>
