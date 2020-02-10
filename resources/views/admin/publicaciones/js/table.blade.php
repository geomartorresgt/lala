<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePublicaciones = $('#datatable_publicaciones');
        var urlPublicaciones = "{{ route('publicaciones.index') }}";

	    $datatablePublicaciones.DataTable({
            autoWidth: true,
            ajax: {
                url: urlPublicaciones,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {
                    render: function (data, type, publicacion) {
                        var miniatura = "<img src=\"" + publicacion.banner_url + "\" style=\"width:150px;border-radius:2px;\" alt="+ publicacion.banner_url +">";
                        return miniatura;
                    }
                },
                {data: 'titulo', class: 'font-weight-bold'},
                {
                    render: function (data, type, publicacion) {
                        var suspensivos = '';
                        var max = 600;

                        if (publicacion.resumen.length > max ) {
                            suspensivos = '...';
                        }

                        return publicacion.resumen.slice(0, max).trim() + suspensivos;
                    }
                },
                {
                    class: 'text-center',
                    render: function (data, type, publicacion) {

                        return publicacion.publicado? 'Si':'No';
                    }
                },
                {
                    class: 'text-center',
                    render: function (data, type, publicacion) {

                        return publicacion.destacado? 'Si':'No';
                    }
                },
                {
                    class: 'text-center',
                    render: function (data, type, publicacion) {
                        var d = new Date(publicacion.created_at);
                        var fecha = `${d.getDate() }/${((d.getMonth() + 1) + '').padStart(2, '0')  }/${d.getFullYear()}`;

                        return fecha;
                    }
                },
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