@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar Evento
                </div>
                <div class="card-body">
					<div class="row mb-3 justify-content-center">
						<div class="col-12 col-lg-6">
							<img src="{{$evento->banner_url}}" alt="{{$evento->titulo}}" width="100%">
						</div>
					</div>
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