@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de Presupuestos
                </div>
                <div class="card-body">
                	@permission('presupuestos_crear')
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('presupuestos.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        @endpermission
        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_presupuestos" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
		                                <tr>
											<th>User_id</th>
											<th>Nombre_cliente</th>
											<th>Email_cliente</th>
											<th>Telefono_cliente</th>
											<th>Cedula_cliente</th>
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
	@include('admin.presupuestos.js.table')
@endpush
