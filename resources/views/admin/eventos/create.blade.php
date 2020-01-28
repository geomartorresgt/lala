@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Nuevo Evento
                </div>
                <div class="card-body">
                	@include('admin.eventos._form', ['evento' => $evento])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form_evento').submit();">
            					Crear
            				</button>
    						<a href="{{ route('eventos.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection

@push('js')
	@include('plugins.datepicker')
	@include('plugins.ckeditor')
@endpush



