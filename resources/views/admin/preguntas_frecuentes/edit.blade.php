@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar pregunta frecuente
                </div>
                <div class="card-body">
                	@include('admin.preguntas_frecuentes._form', ['pregunta_frecuente' => $preguntaFrecuente])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form_preguntas_frecuentes').submit();">
            					Crear
            				</button>
    						<a href="{{ route('preguntas-frecuentes.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection




