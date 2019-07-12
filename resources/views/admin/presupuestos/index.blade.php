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

					@if ( auth()->user()->verificarRol('admin') )
						<div class="container-fluid row">
							<div class="col-md-12">
								
								<form action="#" method="GET">
									<div class="row">
										<div class="col-xs-6 col-md-4">
											<div class="form-group">
												<label class=" control-label" for="fecha_inicio">Fecha de Inicio:</label>
												<input type="text" id="fecha_inicio" name="fecha_inicio"
													class="form-control datepicker" data-date-format="dd/mm/yyyy" value='{{old("fecha_inicio")}}' placeholder="dd/mm/yyyy">
											</div>
										</div>       
				
									<div class="col-xs-6 col-md-4">
											<div class="form-group">
												<label class=" control-label" for="fecha_fin">Fecha Final:</label>
												<input type="text" id="fecha_fin" name="fecha_fin" disabled="disabled"
													class="form-control datepicker" data-date-format="dd/mm/yyyy" value='{{old("fecha_fin")}}' placeholder="dd/mm/yyyy">
											</div>
										</div>

										<div class="col-xs-6 col-md-4">
											<div class="form-group">
												<label class=" control-label" for="local_id">Locales:</label>
												<select id="local" name="local_id" class="form-control">
													<option value="0" selected>- TODOS -</option>
													@foreach($locales as $local)
														<option value="{{ $local->id }}">{{$local->nombre}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
				
									<div class="row">
										<!--
										<div class="col-md-2 offset-md-4">
											<div class="form-group text-right">
												<button class="btn btn-primary btn-effect-ripple btn-theme" id="download-multiple-reports-only-pdfs-btn" type="button">
													<i class="fa fa-cloud-download"></i>
													Descargar Solo PDFS
												</button>
											</div>
										</div>
										-->
				
										<div class="col-md-2 offset-md-8">
											<div class="form-group text-right">
												<button class="btn btn-primary btn-effect-ripple btn-theme" id="refresh" type="button" >Restaurar</button>
											</div>
										</div>
				
										<div class="col-md-2">
											<div class="form-group text-right">
												<button class="btn btn-primary btn-effect-ripple btn-theme" id="filtro" type="button" >Filtrar</button>
											</div>
										</div>
									</div>
								</form>   
							</div>
						</div>
					@endif

        	        <div class="row">
	                    <div class="table-responsive"><br/>
	                        <div class="container-fluid">
                               	<table id="datatable_presupuestos" class="table table-striped  dt-responsive nowrap w-100">
	                                <thead class="">
		                                <tr>
											<th>Usuario</th>
											<th>Local</th>
											<th>Nombre Cliente</th>
											<th>Email Cliente</th>
											<th>Telefono Cliente</th>
											<th>Fecha</th>
											<th>Sub Total</th>
											<th>Descuento</th>
											<th>Iva</th>
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
	@include('plugins.datepicker')
	@include('admin.presupuestos.js.table')
@endpush
