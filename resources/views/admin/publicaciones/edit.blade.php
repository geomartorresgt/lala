@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar publicaciones
                </div>
                <div class="card-body">
                	@include('admin.publicaciones._form', ['publicacion' => $publicacion])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form_publicacion').submit();">
            					Crear
            				</button>
    						<a href="{{ route('publicaciones.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection

@push('js')
	@include('plugins.ckeditor')
@endpush