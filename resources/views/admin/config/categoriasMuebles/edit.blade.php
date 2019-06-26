@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar  CategoriaMueble
                </div>
                <div class="card-body">
                	@include('admin.config.categoriasMuebles._form', ['categoriaMueble' => $categoriaMueble])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form-categoriamueble').submit();">
            					Guardar
            				</button>
    						<a href="{{ route('categorias-muebles.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection
