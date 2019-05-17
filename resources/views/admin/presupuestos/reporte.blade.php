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
                <img src="img/logo.png" alt="" width="150">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col text-left mt-5">
            	<p class="m-0 p-0">
            		<strong>Cliente:</strong>
            		<span>Pedro Perez</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>Cedula:</strong>
            		<span>18377474</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>E-mail:</strong>
            		<span>pj@gmail.com</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>Teléfono:</strong>
            		<span>+334764948746</span>
            	</p>
            	<p class="m-0 p-0">
            		<strong>Fecha Presupuesto:</strong>
            		<span>10/11/2020</span>
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
								<td class="m-1 p-1">$ {{ $presupuestoMueble->mueble->precio }}</td>
            				</tr>
            			@endforeach
            		</tbody>
            		<tfoot>
            			<tr>
            				<td class="border-0" ></td>
            				<td class="border-0" ></td>
            				<td class="text-right m-1 p-1 font-weight-bold">Sub-Total</td>
            				<td class="m-1 p-1">$ {{ $presupuesto->getTotal() }}</td>
            			</tr>
            			<tr>
            				<td class="border-0" ></td>
            				<td class="border-0" ></td>
            				<td class="text-right m-1 p-1 font-weight-bold">Descuento</td>
							<td class="m-1 p-1">$ {{ $presupuesto->descuento }}</td>
            			</tr>
            			<tr>
            				<td class="border-0" ></td>
            				<td class="border-0" ></td>
            				<td class="text-right m-1 p-1 font-weight-bold">Total</td>
            				<td class="m-1 p-1">$ {{ $presupuesto->getTotal() - $presupuesto->descuento }}</td>
            			</tr>
            		</tfoot>
            	</table>
            </div>
        </div>
    </div>

	<div class="page-break"></div>

    <div class="container-fluid">
    	<div class="row justify-content-center">
            <div class="col text-center mb-3">
    			<h4>Capturas del Diseño</h4>
            </div>
		</div>
		
    	@foreach($presupuesto->capturas as $key => $captura)
        	<div class="row justify-content-center mt-5">
	            <div class="col-12 text-center">
					<img src="{{ $captura->img_url }}" alt="" class="img-fluid">
	            </div>
        	</div>
    	@endforeach
    </div>
</body>
</html>