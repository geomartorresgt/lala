<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePermisos = $('#datatable_permisos');
	    var urlPermisos = "{{ route('permisos.index') }}";

	    $datatablePermisos.DataTable({
            ajax: {
                url: "{{ route('permisos.index') }}",
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'name'},
                {data: 'display_name'},
                {data: 'description'},
                {
                    render: function (data, type, permiso) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlPermisos}/${permiso.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;


        				$btnEliminar = `
        					<form action="${urlPermisos}/${permiso.id}" method="POST" class="p-0 m-0 d-inline">
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