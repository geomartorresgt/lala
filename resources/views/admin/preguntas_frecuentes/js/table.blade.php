<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePreguntasFrecuentes = $('#datatable_preguntas_frecuentes');
	    var urlPreguntasFrecuentes = "{{ route('preguntas-frecuentes.index') }}";

	    $datatablePreguntasFrecuentes.DataTable({
            ajax: {
                url: urlPreguntasFrecuentes,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'pregunta'},
                {data: 'respuesta'},
                {
                    render: function (data, type, usuario) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlPreguntasFrecuentes}/${usuario.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;


        				$btnEliminar = `
        					<form action="${urlPreguntasFrecuentes}/${usuario.id}" method="POST" class="p-0 m-0 d-inline">
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