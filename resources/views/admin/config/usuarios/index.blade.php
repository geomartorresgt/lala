@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de usuarios
                </div>
                <div class="card-body">
                	{{-- @permission('usuarios_crear') --}}
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('usuarios.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        {{-- @endpermission --}}
        	        <div class="row">
	                    <br/><br/>
	                    <div class="table-responsive">
	                        <div class="container-fluid">
	                            <table id="datatable_user"
	                                   class="table responsive table_btn table-vcenter dataTable no-footer no-wrap"
	                                   role="grid" aria-describedby="example-datatable_info" width="100%">
	                                <thead>
	                                <tr>
	                                    <th>Nombres</th>
	                                    <th>Teléfono</th>
	                                    <th>E-mail</th>
	                                    <th>Rol</th>
	                                    <th></th>
	                                </tr>
	                                </thead>
	                                <tbody>
	                                	@forelse($usuarios as $usuario)
	                                		<tr>
	                                			<td>
	                                				<img src="{{ $usuario->foto_perfil }}"  style="width:50px;border-radius:25px;" alt="">
	                                				{{ $usuario->nombre_completo }}
	                                			</td>
	                                			<td>
	                                				{{ $usuario->telefono }}
	                                			</td>
	                                			<td>
	                                				{{ $usuario->email }}
	                                			</td>
	                                			<td>
	                                				{{ $usuario->rol }}
	                                			</td>
	                                			<td class="text-center">
	                                				<a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-success edit_user" title="Editar" data-toggle="tooltip">
	                                					<i class="far fa-edit"></i>
	                                				</a>

	                                				<form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="p-0 m-0 d-inline "
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
	                                			<td>No hay usuarios registrados</td>
	                                		</tr>
	                                	@endforelse
	                                </tbody>
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