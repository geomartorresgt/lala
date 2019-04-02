@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de Roles
                </div>
                <div class="card-body">
                	{{-- @permission('roles_crear') --}}
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('roles.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        {{-- @endpermission --}}
        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_roles" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
		                                <tr>
		                                    <th class="text-center">Nombre</th>
		                                    <th class="text-center">Nombre para mostrar</th>
		                                    <th class="text-center">Descripcion</th>
		                                    <th class="text-center">Opciones</th>
		                                </tr>
	                                </thead>
	                            </table>
	                        </div>
	                    </div>
	                </div>
        	        <div class="row">
	                </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
@push('js')
	@include('admin.config.privilegios.roles.js.table')
@endpush