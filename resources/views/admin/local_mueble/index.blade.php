@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
			<form action="{{ route('localMueble.store') }}" method="POST" >
				<div class="card">
					<div class="card-header">
						Listado de Muebles
					</div>
					<div class="card-body">
						<div class="row">
							@forelse($muebles as $mueble)
								<div class="col-12 col-md-6 col-lg-6 mb-4">
									<div class="media">
										<img class="align-self-center mr-3" width="100" src="{{ $mueble->foto_url }}" alt="Generic placeholder image">
										<div class="media-body">
											<h5 class="mt-0">{{ $mueble->nombre }}</h5>
											<p class="mb-0">Precio: </p>
											<input type="text" name="muebles[{{ $mueble->id }}]" value="{{ old( "muebles[$mueble->id]", optional($mueble->localMuebles->first())->precio ) }}" class="form-control w-50" placeholder="$ 0,00" >
										</div>
									</div>
								</div>
							@empty
								<div class="col-12 text-center">
									<p>No hay muebles.</p>
								</div>
							@endforelse
							
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col text-right">
								<button type="submit" id="btn-form-usuarios" class="btn btn-primary btn-effect-ripple" >
									Guardar
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
        <!-- /.col-->
    </div>
@endsection
@push('js')
	@include('admin.config.muebles.js.table')
@endpush
