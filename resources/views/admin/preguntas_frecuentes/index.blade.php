@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de preguntas frecuentes
                </div>
                <div class="card-body">
                	@permission('usuarios_crear')
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('preguntas-frecuentes.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nuevo
            	                </a>
            	            </div>
            	        </div>
        	        @endpermission
        	        <div class="row">
	                    <br/><br/>
	                    <div class="table-responsive">
	                        <div class="container-fluid">
	                            <table id="datatable_preguntas_frecuentes"
	                                   class="table responsive table_btn table-vcenter dataTable no-footer no-wrap"
	                                   role="grid" aria-describedby="example-datatable_info" width="100%">
	                                <thead>
		                                <tr>
		                                    <th>Pregunta</th>
		                                    <th>Respuesta</th>
		                                    <th></th>
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
	@include('admin.preguntas_frecuentes.js.table')
@endpush