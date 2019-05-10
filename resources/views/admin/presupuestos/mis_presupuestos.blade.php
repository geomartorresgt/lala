@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de mis presupuestos
                </div>
                <div class="card-body">
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