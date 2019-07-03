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
						<select id="categorias" class="form-control mb-3">
							<option value="">Todas las categorías</option>
							@foreach ($categoriasMuebles as $categoria)
								<option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
							@endforeach
						</select>
						<div class="content-categorias">
							@foreach ($categoriasMuebles as $categoria)
								<div class="row" id="row_categoria_{{ $categoria->id }}">
									<h4 class="col-12 mb-3 text-left">{{$categoria->nombre}}</h4>
									@forelse($categoria->muebles as $mueble)
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
							@endforeach
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
	@include('admin.local_mueble.js.index')
@endpush
