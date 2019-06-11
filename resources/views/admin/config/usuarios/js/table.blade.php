<script type="text/javascript">
	$(document).ready(function() {
	    var $datatableUsers = $('#datatable_users');
	    var urlUsuarios = "{{ route('usuarios.index') }}";

	    $datatableUsers.DataTable({
            ajax: {
                url: "{{ route('usuarios.index') }}",
                type: "GET",
                dataSrc: ''
            },
            columns: [
            	{
                    render: function (data, type, usuario) {
                        var logo = "<img src=\"" + usuario.foto_perfil + "\" style=\"width:50px;border-radius:25px;\"alt=\"\"> <span>" + usuario.nombre_completo + "</span>";
                        return (logo);
                    }
                },
                {data: 'telefono'},
                {data: 'email'},
                {data: 'rol'},
                {
                    render: function (data, type, usuario) {

                        if(!usuario.local) return 'n/a ';
                        return usuario.local.nombre;
                    }
                },
                {
                    render: function (data, type, usuario) {
                    	var $btnEditar = '';
                    	var $btnEliminar = '';	

                        $btnEditar = `<a href="${urlUsuarios}/${usuario.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
        					<i class="far fa-edit"></i>
        				</a>`;


        				$btnEliminar = `
        					<form action="${urlUsuarios}/${usuario.id}" method="POST" class="p-0 m-0 d-inline">
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