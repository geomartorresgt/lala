@if ($preguntaFrecuente->exists)
<form id="form_preguntas_frecuentes" class="form-horizontal form-label-left" action={{ route('preguntas-frecuentes.update',  $preguntaFrecuente->id) }} method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
<form id="form_preguntas_frecuentes" class="form-horizontal form-label-left" action={{ route('preguntas-frecuentes.store') }} method="POST" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="pregunta">Pregunta:</label>
                <div class="col-md-9">
                    <input id="pregunta" name="pregunta" class="form-control" type="text" value='{{old("pregunta", $preguntaFrecuente->pregunta)}}'>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="respuesta">Respuesta:</label>
                <div class="col-md-9">
                    <textarea name="respuesta" id="" cols="30" rows="5" class="form-control">{{old("respuesta", $preguntaFrecuente->respuesta)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>
