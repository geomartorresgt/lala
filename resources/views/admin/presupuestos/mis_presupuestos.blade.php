@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de mis presupuestos
                </div>
                <div class="card-body">
					@permission('presupuestos_crear')
					@if (auth()->user()->local_id )
						<div class="row m-0 mb-2 ">
							<div class="col-md-12 text-right">
								<a href="{{ route('presupuestos.create') }}" class="btn btn-info btn-effect-ripple text-white">
									<i class="fa fa-plus"></i> 
									Nuevo
								</a>
							</div>
						</div>
					@endif
					@endpermission
        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_presupuestos" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
		                                <tr>
											<th>Usuario</th>
											<th>Nombre Cliente</th>
											<th>Email Cliente</th>
											<th>Telefono Cliente</th>
											<th>Cedula Cliente</th>
											<th>Fecha</th>
											<th>Descuento</th>
											<th>Total</th>
											<th>Opciones</th>
		                                </tr>
	                                </thead>
	                            </table>
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
@push('js')
	@include('admin.presupuestos.js.mis_presupuestos')
@endpush
{{-- presupuestos.misPresupuestos --}}