<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableCapturas = $('#datatable_capturas');
	    var urlPresupuestoCapturas = "{{ route('presupuestosCapturas.index', $presupuesto) }}";

	    $datatableCapturas.DataTable({
            ajax: {
                url: urlPresupuestoCapturas,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'id', visible: false},
				{
                    render: function (data, type, capturaPresupuesto) {
                        var miniatura = "<img src=\"" + capturaPresupuesto.img_url + "\" style=\"width:80%;\" class='img-thumbnail' alt="+ 'image' +">";
                        return (miniatura);
                    }
                },
				{
                    render: function (data, type, capturaPresupuesto) {
                    	var $btnEliminar = '';	

                        @permission('capturas_eliminar')
                            $btnEliminar = `
                                <button class="btn btn-sm btn-danger btn-eliminar-presupuesto-captura" title="Eliminar" data-toggle="tooltip" data-presupuesto-captura="${capturaPresupuesto.id}">
                                    <i class="far fa-trash-alt"></i>	
                                </button>
                            `;
						@endpermission

        				return $btnEliminar;
                    }
                },
            ]
        });

        $('#datatable_capturas').on('click', '.btn-eliminar-presupuesto-captura', function(e){
            var presupuesto_captura_id = $(this).data('presupuesto-captura');
            var url = `${urlPresupuestoCapturas}/${presupuesto_captura_id}`;

            $.ajax({
                type: 'DELETE',
                url: url,
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    if (data.success) {
                        console.log('elimino bien, a refrescar la table');
                        
                        $datatableCapturas.DataTable().ajax.reload();
                    }
                }
            });
        });
	});
</script>
