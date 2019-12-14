<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePublicaciones = $('#datatable_publicaciones');
	    var urlPublicaciones = "{{ route('publicaciones.index') }}";

	    $datatablePublicaciones.DataTable({
            ajax: {
                url: urlPublicaciones,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'titulo'},
                {data: 'contenido'},
                {
                    render: function (data, type, usuario) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlPublicaciones}/${usuario.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;


        				$btnEliminar = `
        					<form action="${urlPublicaciones}/${usuario.id}" method="POST" class="p-0 m-0 d-inline">
        					    @method('DELETE')
        					    @csrf
        					    <button class="btn btn-sm btn-danger" title="Eliminar" data-toggle="tooltip">
        					    	<i class="far fa-trash-alt"></i>	
        					    </button>
        					</form>
        				`;

        				return $btnEditar + $btnEliminar;
                    }
                },
            ]
        });

	});
</script>