<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableCategorias = $('#datatable_categorias');
	    var urlCategorias = "{{ route('categorias.index') }}";

	    $datatableCategorias.DataTable({
            ajax: {
                url: urlCategorias,
                type: "GET",
                dataSrc: ''
            },
            columns: [
				{
					render: function (data, type, categoria) {
                        var miniatura = "<img src=\"" + categoria.icono_url + "\" style=\"width:50px;border-radius:2px;\" alt="+ categoria.icono_url +">";
                        return miniatura;
                    }
				},
				{data: 'nombre'},
				{
					render: function (data, type, categoria) {
                        var suspensivos = '';
                        var max = 600;

                        if (categoria.resumen.length > max ) {
                            suspensivos = '...';
                        }

                        return categoria.resumen.slice(0, max).trim() + suspensivos;
                    }
				},
				{data: 'clave'},
				{
                    class: 'text-center',
                    render: function (data, type, categoria) {
                        return categoria.incio? 'Si':'No';
                    }
                },
                {
                    render: function (data, type, categoria) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlCategorias}/${categoria.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;

        				$btnEliminar = `
        					<form action="${urlCategorias}/${categoria.id}" method="POST" class="p-0 m-0 d-inline">
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