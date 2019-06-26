<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableTexturas = $('#datatable_texturas');
	    var urlTexturas = "{{ route('texturas.index') }}";

	    $datatableTexturas.DataTable({
            ajax: {
                url: urlTexturas,
                type: "GET",
                dataSrc: ''
            },
            columns: [
				{
                    render: function (data, type, textura) {
                        var miniatura = "<img src=\"" + textura.img + "\" style=\"width:80px;\" class='img-thumbnail' alt="+ textura.nombre +">";
                        return (miniatura);
                    }
                },
                {data: 'nombre'},
				{data: 'tipo_textura'},
				{
					render: function (data, type, textura) {
						return textura.activo? 'Si' : 'No';
					}
				},
				{
                    render: function (data, type, textura) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

	                	@permission('texturas_editar')
							$btnEditar = `<a href="${urlTexturas}/${textura.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
								<i class="far fa-edit"></i>
							</a>`;
	        	        @endpermission

	                	@permission('texturas_eliminar')
							$btnEliminar = `
								<form action="${urlTexturas}/${textura.id}" method="POST" class="p-0 m-0 d-inline">
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
