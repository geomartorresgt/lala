@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Nuevo Local
                </div>
                <div class="card-body">
                	@include('admin.config.locales._form', ['local' => $local])
            	</div>
            	<div class="card-footer">
            		<div class="row">
            			<div class="col text-right">
            				<button type="button" class="btn btn-primary btn-effect-ripple" id="btn-form">
            					Guardar
            				</button>
    						<a href="{{ route('locales.index') }}" class="btn btn-secondary btn-effect-ripple text-dark">Atras</a>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>	
@endsection
@push('js')
	@include('admin.config.locales.js.form')
@endpush