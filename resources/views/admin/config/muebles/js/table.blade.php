<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableMuebles = $('#datatable_muebles');
	    var urlMuebles = "{{ route('muebles.index') }}";

	    $datatableMuebles.DataTable({
            ajax: {
                url: urlMuebles,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'codigo'},
                {data: 'nombre'},
				{
                    render: function (data, type, mueble) {
                        var miniatura = "<img src=\"" + mueble.foto_url + "\" style=\"width:80px;\" class='img-thumbnail' alt="+ mueble.nombre +">";
                        return (miniatura);
                    }
                },
				{data: 'dimensiones'},
				{data: 'nombre_categoria'},
				{data: 'precio',
					render: function (data, type, mueble) {
						return `U$S ${mueble.precio}`;
					}
				},
				{
                    render: function (data, type, mueble) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

	                	@permission('muebles_editar')
							$btnEditar = `<a href="${urlMuebles}/${mueble.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
								<i class="far fa-edit"></i>
							</a>`;
	        	        @endpermission

	                	@permission('muebles_eliminar')
							$btnEliminar = `
								<form action="${urlMuebles}/${mueble.id}" method="POST" class="p-0 m-0 d-inline">
									@method('DELETE')
									@csrf
									<button class="btn btn-sm btn-danger" title="Eliminar" data-toggle="tooltip">
										<i class="far fa-trash-alt"></i>	
									</button>
								</form>
							`;
						@endpermission


        				return $btnEditar + $btnEliminar;
                    }
                },
            ]
        });
	});
</script>
