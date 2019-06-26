@if ($presupuesto->exists)
<form id="form-presupuesto" class="form-horizontal form-label-left" action="{{ route('presupuestos.update', $presupuesto->id) }}" method="POST">
    	{{ method_field('PUT') }}
@else
<form id="form-presupuesto" class="form-horizontal form-label-left" action="{{ route('presupuestos.store') }}" method="POST">
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="form-group col-12 col-md-6 d-none" >
            <label for="user_id">User_id</label>
            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{old('user_id', $presupuesto->user_id)}}" required>
        </div>
        <div class="form-group col-12 col-md-6" >
            <label for="nombre_cliente">Nombre Cliente</label>
            <input type="text" id="nombre_cliente" name="nombre_cliente" class="form-control" value="{{old('nombre_cliente', $presupuesto->nombre_cliente)}}" required>
        </div>
        <div class="form-group col-12 col-md-6" >
            <label for="email_cliente">Email Cliente</label>
            <input type="text" id="email_cliente" name="email_cliente" class="form-control" value="{{old('email_cliente', $presupuesto->email_cliente)}}" required>
        </div>
        <div class="form-group col-12 col-md-6" >
            <label for="telefono_cliente">Telefono Cliente</label>
            <input type="text" id="telefono_cliente" name="telefono_cliente" class="form-control" value="{{old('telefono_cliente', $presupuesto->telefono_cliente)}}" required>
        </div>
        <div class="form-group col-12 col-md-6" >
            <label for="fecha">Fecha</label>
            <input type="text" disabled id="fecha" name="fecha" class="form-control" value="{{old('fecha', $presupuesto->fecha)}}" required>
        </div>
        <div class="form-group col-12 col-md-6" >
            <label for="descuento">Descuento (%)</label>
            <input type="text" id="descuento" name="descuento" class="form-control" value="{{old('descuento', $presupuesto->descuento)}}" required>
        </div>
    </div>
</form>


