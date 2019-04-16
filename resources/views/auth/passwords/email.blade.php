@extends('layouts.app')

@section('content')
	<div class="row mt-5">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/logo.png') }}">
        </div>
    </div>
	<div class="row justify-content-center mt-5">
	    <div class="col-6">
	    	<div class="row">
			    <div class="col-md-12">
			        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown text-dark">
				        <i class="fa fa-history"></i> <strong>Recuperar Contraseña</strong>
				    </h1>
			    </div>
			    <div class="col-12">
			    	<div class="card">
			    		<div class="card-header">
			    			<span class="card-title">Ingrese el e-mail que inicia sesión</span>
			    		</div>
			    		<div class="card-body">
			    			<!-- Reminder Form -->
			    			<form id="form-reminder" action="{{ route('password.email') }}" method="POST" autocomplete="off" class="form-horizontal">
			    			    {{ csrf_field() }}
			    			    @if (session('status'))
			    			        <div class="alert alert-success" role="alert">
			    			            {{ session('status') }}
			    			        </div>
			    			    @endif
			    			    <div class="form-group">
			    			        <div class="col-xs-12">
			    			            <input type="text" id="reminder-email" name="email" class="form-control {{ $errors->has('email')? 'is-invalid' : null }}" placeholder="E-mail">
			    			            @if ($errors->has('email'))
			    			                <span class="text-danger" role="">
			    			                    <strong>{{ $errors->first('email') }}</strong>
			    			                </span>
			    			            @endif
			    			        </div>
			    			    </div>
			    			    <div class="form-group form-actions">
			    			        <div class="col-xs-12 text-right">
			    			            <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Recuperar Contraseña</button>
			    			        </div>
			    			    </div>
			    			</form>
			    		</div>
			    	</div>
			    </div>
	    	</div>
	    </div>
	</div>
@endsection