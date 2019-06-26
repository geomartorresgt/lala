<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableMuebles = $('#datatable_muebles');
	    var urlPresupuestoMuebles = "{{ route('presupuestosMuebles.index', $presupuesto) }}";

	    $datatableMuebles.DataTable({
            ajax: {
                url: urlPresupuestoMuebles,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'mueble.nombre'},
				{data: 'mueble.directorio_url'},
				{
                    render: function (data, type, presupuestoMueble) {
                        var miniatura = "<img src=\"" + presupuestoMueble.mueble.foto_url + "\" style=\"width:80px;\" class='img-thumbnail' alt="+ presupuestoMueble.mueble.nombre +">";
                        return (miniatura);
                    }
                },
				{data: 'mueble.dimensiones'},
                {data: 'mueble.nombre_categoria'},
                {
					render: function (data, type, presupuestoMueble) {
						return `U$S ${presupuestoMueble.local_mueble.precio}`;
					}
				},
				{
                    render: function (data, type, presupuestoMueble) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        @permission('muebles_eliminar')
                            $btnEliminar = `
                                <button class="btn btn-sm btn-danger btn-eliminar-presupuesto-mueble" title="Eliminar" data-toggle="tooltip" data-presupuesto-mueble="${presupuestoMueble.id}">
                                    <i class="far fa-trash-alt"></i>	
                                </button>
                            `;
						@endpermission

        				return $btnEditar + $btnEliminar;
                    }
                },
            ]
        });

        $('#datatable_muebles').on('click', '.btn-eliminar-presupuesto-mueble', function(e){
            var presupuesto_mueble_id = $(this).data('presupuesto-mueble');
            var url = `${urlPresupuestoMuebles}/${presupuesto_mueble_id}`;

            $.ajax({
                type: 'DELETE',
                url: url,
                dataType: 'json',
                success:function(data){
                    if (data.success) {
                        $datatableMuebles.DataTable().ajax.reload();
                    }
                }
            });
        });
	});
</script>
