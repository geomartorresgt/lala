<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Listado de Muebles
            </div>
            <div class="card-body">
                <div class="row">
                    @include('admin.config.muebles._table')
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
	@include('admin.presupuestos.muebles.js.table')
@endpush