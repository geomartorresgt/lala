@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar publicación
                </div>
                <div class="card-body">
					<div class="row mb-3 justify-content-center">
						<div class="col-12 col-lg-6">
							<img src="{{$publicacion->banner_url}}" alt="{{$publicacion->titulo}}" width="100%">
						</div>
					</div>
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