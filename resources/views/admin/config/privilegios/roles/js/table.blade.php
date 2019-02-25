
<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableRoles = $('#datatable_roles');
	    var urlRoles = "{{ route('roles.index') }}";

	    $datatableRoles.DataTable({
            ajax: {
                url: "{{ route('roles.index') }}",
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'name'},
                {data: 'display_name'},
                {data: 'description'},
                {
                    render: function (data, type, rol) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlRoles}/${rol.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;


        				$btnEliminar = `
        					<form action="${urlRoles}/${rol.id}" method="POST" class="p-0 m-0 d-inline">
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