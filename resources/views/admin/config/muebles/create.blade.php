@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Nuevo  Mueble
                </div>
                <div class="card-body">
                	@include('admin.config.muebles._form', ['mueble' => $mueble])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" id="btn-form" class="btn btn-primary btn-effect-ripple" >
            					Guardar
            				</button>
    						<a href="{{ route('muebles.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection

@push('js')
	@include('admin.config.muebles.js.form')
@endpush
