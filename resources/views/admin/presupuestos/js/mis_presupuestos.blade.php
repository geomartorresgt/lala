<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePresupuestos = $('#datatable_presupuestos');
        var urlPresupuestos = "{{ route('presupuestos.index') }}";
	    var urlMisPresupuestos = "{{ route('presupuestos.misPresupuestos') }}";
        

	    $datatablePresupuestos.DataTable({
            ajax: {
                url: urlMisPresupuestos,
                type: "GET",
                dataSrc: ''
            },
            columns: [
                {data: 'user_id'},
				{data: 'nombre_cliente'},
				{data: 'email_cliente'},
				{data: 'telefono_cliente'},
				{data: 'fecha'},
				{
					render: function (data, type, presupuesto) {
						return `U$S ${presupuesto.descuento_dinero}`;
					}
				},
				{
					render: function (data, type, presupuesto) {
						return `U$S ${presupuesto.total}`;
					}
				},
				{
                    render: function (data, type, presupuesto) {
                    	var $btnEditar = '';
						var $btnEliminar = '';	
						var $btnEditarDiseno = ''

	                	@permission('presupuestos_editar')
							$btnEditar = `<a href="${urlPresupuestos}/${presupuesto.id}/edit" class="btn btn-sm btn-success" title="Editar" data-toggle="tooltip">
								<i class="far fa-edit"></i>
							</a>`;
	        	        @endpermission

	                	@permission('presupuestos_eliminar')
							$btnEliminar = `
								<form action="${urlPresupuestos}/${presupuesto.id}" method="POST" class="p-0 m-0 d-inline">
									@method('DELETE')
									@csrf
									<button class="btn btn-sm btn-danger" title="Eliminar" data-toggle="tooltip">
										<i class="far fa-trash-alt"></i>	
									</button>
								</form>
							`;
						@endpermission

						$btnEditarDiseno = `
							<a href="${urlPresupuestos}/${presupuesto.id}/edit-diseno" class="btn btn-sm btn-info btn-edit-diseno text-white" title="Editar Diseño" data-toggle="tooltip" data-presupuesto="${presupuesto.id}">
								<i class="fas fa-palette"></i>
							</a>
						`;

						$btnPdf = `
							<button class="btn btn-sm btn-warning text-white btn-reporte" type="button" title="Reporte" data-toggle="tooltip" data-presupuesto="${presupuesto.id}">
								<i class="far fa-file-pdf"></i>
							</button>
						`;

						if(presupuesto.gltf_url !=null){
							$btnVisor= `
							
								<a href="{{ url('/visor') }}/${presupuesto.gltf_url}" class="btn btn-sm btn-info btn-edit-diseno text-white" title="Editar Diseño" data-toggle="tooltip" data-presupuesto="${presupuesto.id}">
									<i class="fas fa-glasses"></i>
								</a>
							
							`;
						}else{
							$btnVisor='';
						}
        				return $btnEditar + $btnEditarDiseno + $btnPdf + $btnVisor + $btnEliminar;
                    }
                },
            ]
		});

		$('#datatable_presupuestos').on('click', '.btn-edit-diseno', function(e, options){
			var options = options || {};
			var presupuesto_id = $(this).data('presupuesto')
			e.preventDefault();

			if (presupuesto_id && !options.redirect) {
				setLocalStorage( presupuesto_id )
					.then( presupuesto_id => {
						localStorage.setItem("presupuesto_id", presupuesto_id)
						$(e.currentTarget).trigger('click', { 'redirect': true });
					})
					.catch(error => console.error(error))
			} else {
				window.location = e.target.href;
			}
		});

		$('#datatable_presupuestos').on('click', '.btn-reporte', function(e){
			e.preventDefault();
			var presupuesto_id = $(this).data('presupuesto')
			var urlReporte = `${urlPresupuestos}/${presupuesto_id}/reporte`;
			window.open(urlReporte, '_blank');
			return;
		});
		

	});

	function setLocalStorage( presupuesto_id ) {
		return new Promise( (resolve, reject) => {
			setTimeout(
				() => presupuesto_id > 0
					? resolve(presupuesto_id)
					: reject( new Error('Presupuesto no encontrado') ),
				0
			);
		});
	}
</script>
