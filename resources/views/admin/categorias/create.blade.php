@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Nueva categoría
                </div>
                <div class="card-body">
                	@include('admin.categorias._form', ['categoria' => $categoria])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form_categoria').submit();">
            					Crear
            				</button>
    						<a href="{{ route('categorias.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
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