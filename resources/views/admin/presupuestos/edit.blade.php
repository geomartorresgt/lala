@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Actualizar  Presupuesto
                </div>
                <div class="card-body">
                	@include('admin.presupuestos._form', ['presupuesto' => $presupuesto])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" onclick="document.getElementById('form-presupuesto').submit();">
            					Guardar
            				</button>
    						<a href="{{ route('presupuestos.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
	</div>	
	
	@include('admin.presupuestos.muebles._index')
@endsection
