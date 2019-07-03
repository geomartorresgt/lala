<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableCategoriaMuebles = $('#datatable_locales');
	    var urlLocales = "{{ route('locales.index') }}";

	    $datatableCategoriaMuebles.DataTable({
            ajax: {
                url: urlLocales,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {
					render: function(data, type, local) {
						var img = `
							<img src="${local.logo}" alt="${local.nombre}" width="50" />
						`;
						return img;
					}
				},
                {data: 'nombre'},
                {data: 'direccion'},
                {data: 'telefono_contacto'},
				{
                    render: function (data, type, local) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

	                	@permission('local_editar')
							$btnEditar = `<a href="${urlLocales}/${local.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
								<i class="far fa-edit"></i>
							</a>`;
	        	        @endpermission

	                	@permission('local_eliminar')
							$btnEliminar = `
								<form action="${urlLocales}/${local.id}" method="POST" class="p-0 m-0 d-inline">
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
