<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Presupuesto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
    	td, th {
    		border-color: #777 !important ;
    	}

    	.page-break {
    	    page-break-after: always;
		}
		
		p, strong, span, td {
			font-size: .8rem;
		}
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center">
				<img src="{{$presupuesto->local->logo}}" alt="{{$presupuesto->local->nombre}}" width="120" />
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col text-left mt-2">
            	<p class="m-0 p-0">
            		<strong>Cliente:</strong>
					<span>{{ $presupuesto->nombre_cliente }}</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>Cédula / Rut:</strong>
					<span>{{ $presupuesto->cedula_cliente }}</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>E-mail:</strong>
					<span>{{ $presupuesto->email_cliente }}</span>            		
            	</p>
            	<p class="m-0 p-0">
            		<strong>Teléfono:</strong>
					<span>{{ $presupuesto->telefono_cliente }}</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>Fecha Presupuesto:</strong>
					<span>{{ $presupuesto->fecha }}</span>
            	</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col text-center mt-3">
                <h4>Reporte Presupuesto</h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col text-center mt-2">
            	<table class="table table-bordered border-bottom-0 border-left-0">
            		<thead>
            			<tr>
            				<th>Mueble</th>
            				<th>Dimensiones</th>
            				<th>Categoría</th>
            				<th>Precio</th>
            			</tr>
            		</thead>
            		<tbody>
            			@foreach( $presupuesto->muebles as $key => $presupuestoMueble )
            				<tr>
								<td class="m-1 p-1">{{ $presupuestoMueble->mueble->nombre }}</td>
								<td class="m-1 p-1">{{ $presupuestoMueble->mueble->dimensiones }}</td>
								<td class="m-1 p-1">{{ $presupuestoMueble->mueble->categoria->nombre }}</td>
								<td class="m-1 p-1">U$S {{ $presupuestoMueble->localMueble->precio }}</td>
            				</tr>
            			@endforeach
            		</tbody>
            		<tfoot>
            			<tr>
            				<td class="border-0" ></td>
            				<td class="border-0" ></td>
            				<td class="text-right m-1 p-1 font-weight-bold">Sub-Total</td>
            				<td class="m-1 p-1">U$S {{ $presupuesto->getTotal() }}</td>
						</tr>
						@if( $presupuesto->tieneDescuento() )
							<tr>
								<td class="border-0" ></td>
								<td class="border-0" ></td>
								<td class="text-right m-1 p-1 font-weight-bold">Descuento</td>
								<td class="m-1 p-1">U$S {{ $presupuesto->descuento_dinero }}</td>
							</tr>
						@endif
						<tr>
							<td class="border-0" ></td>
							<td class="border-0" ></td>
							<td class="text-right m-1 p-1 font-weight-bold">Iva</td>
							<td class="m-1 p-1">U$S {{ $presupuesto->monto_iva }}</td>
						</tr>
            			<tr>
            				<td class="border-0" ></td>
            				<td class="border-0" ></td>
            				<td class="text-right m-1 p-1 font-weight-bold">Total</td>
            				<td class="m-1 p-1">U$S {{  $presupuesto->total }}</td>
            			</tr>
            		</tfoot>
            	</table>
            </div>
        </div>
	</div>
	
	@if ($presupuesto->capturas->count())
		<div class="page-break"></div>

		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col text-center mb-3">
					<h4>Capturas del Diseño</h4>
				</div>
			</div>
			
			@foreach($presupuesto->capturas as $key => $captura)
				<div class="row justify-content-center mt-3 mb-3">
					<div class="col-12 text-center">
						<img src="{{ $captura->img_url }}" alt="" class="img-fluid">
					</div>
				</div>
			@endforeach
		</div>
	@endif
	
</body>
</html>