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
                        var miniatura = "<img src=\"" + evento.banner_url + "\" style=\"width:150px;border-radius:2px;\" alt="+ evento.banner_url +">";
                        return miniatura;
                    }
                },
                {data: 'titulo'},
                {
                    render: function (data, type, evento) {
                        var suspensivos = '';
                        var max = 600;

                        if (evento.resumen.length > max ) {
                            suspensivos = '...';
                        }

                        return evento.resumen.slice(0, max).trim() + suspensivos;
                    }
                },
                {
                    class: 'text-center',
                    render: function (data, type, evento) {

                        return evento.publicado? 'Si':'No';
                    }
                },
                {
                    class: 'text-center',
                    render: function (data, type, evento) {

                        return evento.destacado? 'Si':'No';
                    }
                },
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