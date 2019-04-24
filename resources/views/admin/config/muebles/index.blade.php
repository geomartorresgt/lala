@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de Muebles
                </div>
                <div class="card-body">
                	@permission('muebles_crear')
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('muebles.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        @endpermission
        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_muebles" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
		                                <tr>
											<th>Nombre</th>
											<th>Directorio_url</th>
											<th>Foto_url</th>
											<th>Dimensiones</th>
											<th>Categoria_mueble_id</th>
											<th>Precio</th>
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
	@include('admin.config.muebles.js.table')
@endpush
