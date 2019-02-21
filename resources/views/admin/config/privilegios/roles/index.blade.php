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
	                            <table class="table responsive table_btn table-vcenter dataTable no-footer no-wrap"
	                                   id="role_table" width="100%">
	                                <thead class="">
	                                <tr>
	                                    <th class="text-center">Nombre</th>
	                                    <th class="text-center">Nombre para mostrar</th>
	                                    <th class="text-center">Descripcion</th>
	                                    <th class="text-center">Opciones</th>
	                                </tr>
	                                </thead>
	                                <tbody>
	                                	@forelse($roles as $rol)
	                                		<tr>
	                                			<td>
	                                				{{ $rol->name }}
	                                			</td>
	                                			<td>
	                                				{{ $rol->display_name }}
	                                			</td>
	                                			<td>
	                                				{{ $rol->description }}
	                                			</td>
	                                			<td class="text-center">
	                                				<a href="{{ route('roles.edit', $rol) }}" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
	                                					<i class="far fa-edit"></i>
	                                				</a>

	                                				<form action="{{ route('roles.destroy', $rol) }}" method="POST" class="p-0 m-0 d-inline "
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
	                                </tbody>
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