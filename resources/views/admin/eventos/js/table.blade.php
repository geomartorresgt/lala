<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableEventos = $('#datatable_eventos');
	    var urlEventos = "{{ route('eventos.index') }}";

	    $datatableEventos.DataTable({
            ajax: {
                url: urlEventos,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {
                    render: function (data, type, evento) {
                        var logo = "<img src=\"" + evento.banner + "\" style=\"width:50px;\"alt=\"\"> ";
                        return (logo);
                    }
                },
                {data: 'titulo'},
                {data: 'descripcion'},
                {data: 'fecha'},
                {
                    render: function (data, type, evento) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlEventos}/${evento.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;

        				$btnEliminar = `
        					<form action="${urlEventos}/${evento.id}" method="POST" class="p-0 m-0 d-inline">
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