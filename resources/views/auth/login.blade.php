@extends('layouts.app')

@section('content')
	<div class="row mt-5">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/logo.png') }}">
        </div>
    </div>
	<div class="row justify-content-center mt-5">
	    <div class="col-md-6">
	        <div class="card mx-4 mt-5">
	            <div class="card-body p-4">
	                <h1 class="text-center mt-2">Iniciar Sección</h1>
	                <p class="text-muted">Bienvenido, Inicia Sesion para continuar</p>
	                <form id="form-login" method="POST" action="{{ route('login') }}" autocomplete="off" class="form-horizontal">
		                {{ csrf_field() }}
		                <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                        <span class="input-group-text">@</span>
		                    </div>
		                    <input
		                        class="form-control"
		                        type="text"
		                        placeholder="Email"
		                        name="email"
		                    />
		                    @if ($errors->has('email'))
	                            <span class="red-text text-helper">{{ $errors->first('email') }}</span>
	                        @endif
		                </div>
		                <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                        <span class="input-group-text">
		                            <i class="fas fa-lock"></i>
		                        </span>
		                    </div>
		                    <input
		                        class="form-control"
		                        type="password"
		                        placeholder="Password"
		                        name="password"
		                    />
		                    @if ($errors->has('password'))
                                <span class="red-text text-helper">{{ $errors->first('password') }}</span>
                            @endif
		                </div>
		                <button class="btn btn-block btn-success" type="submit">
		                    Entrar
		                </button>
	                    <div class="row mt-3">
	                    	<div class="col-12 text-right">
	                            <a href="{{ route('password.request') }}" class="text-decoration-none">
	                            	¿Olvido su Contraseña?
	                            </a>
	                        </div>
	                    </div>
		            </form>
	            </div>
	            {{-- <div class="card-footer p-4">
	                
	            </div> --}}
	        </div>
	    </div>
	</div>
@endsection