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
            	                <a href="{{ route('permisos.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        {{-- @endpermission --}}
        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_permisos" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
	                                <tr>
	                                    <tr>
				                            <th class="text-center">Nombre</th>
				                            <th class="text-center">Nombre para mostrar</th>
				                            <th class="text-center">Descripcion</th>
				                            <th class="text-center">Opciones</th>
				                        </tr>
	                                </tr>
	                                </thead>
	                                {{-- <tbody>
	                                	@forelse($permisos as $permiso)
	                                		<tr>
	                                			<td>
	                                				{{ $permiso->name }}
	                                			</td>
	                                			<td>
	                                				{{ $permiso->display_name }}
	                                			</td>
	                                			<td>
	                                				{{ $permiso->description }}
	                                			</td>
	                                			<td class="text-center">
	                                				<a href="{{ route('permisos.edit', $permiso) }}" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
	                                					<i class="far fa-edit"></i>
	                                				</a>

	                                				<form action="{{ route('permisos.destroy', $permiso) }}" method="POST" class="p-0 m-0 d-inline "
	                                				  >
	                                				    @method('DELETE')
	                                				    @csrf
	                                				    <button class="btn btn-sm btn-danger" title="Eliminar" data-toggle="tooltip">
	                                				    	<i class="far fa-trash-alt"></i>	
	                                				    </button>
	                                				</form>
	                                			</td>
	                                		</tr>
	                                	@empty
	                                		<tr>
	                                			<td>No hay roles registrados</td>
	                                		</tr>
	                                	@endforelse
	                                </tbody> --}}
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
	@include('admin.config.privilegios.permisos.js.table')
@endpush