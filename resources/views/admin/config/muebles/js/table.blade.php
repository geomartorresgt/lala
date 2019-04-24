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
                {data: 'nombre'},
				{data: 'directorio_url'},
				{data: 'foto_url'},
				{data: 'dimensiones'},
				{data: 'categoria_mueble_id'},
				{data: 'precio'},
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
