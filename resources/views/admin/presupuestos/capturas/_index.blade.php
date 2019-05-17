<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Listado de Capturas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive px-1">
                        <table id="datatable_capturas" class="table table-striped  dt-responsive nowrap w-100">
                            <thead class="">
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen</th>
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

@push('js')
    @include('admin.presupuestos.capturas.js.table')
@endpush