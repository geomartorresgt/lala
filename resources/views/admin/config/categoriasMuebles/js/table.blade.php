<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableCategoriaMuebles = $('#datatable_categoriamuebles');
	    var urlCategoriaMuebles = "{{ route('categorias-muebles.index') }}";

	    $datatableCategoriaMuebles.DataTable({
            ajax: {
                url: urlCategoriaMuebles,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'nombre'},
				{
                    render: function (data, type, categoriaMueble) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

	                	@permission('categorias_muebles_editar')
							$btnEditar = `<a href="${urlCategoriaMuebles}/${categoriaMueble.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
								<i class="far fa-edit"></i>
							</a>`;
	        	        @endpermission

	                	@permission('categorias_muebles_eliminar')
							$btnEliminar = `
								<form action="${urlCategoriaMuebles}/${categoriaMueble.id}" method="POST" class="p-0 m-0 d-inline">
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
