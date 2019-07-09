<script type="text/javascript">
	$(document).ready(function() {
	    var $datatablePresupuestos = $('#datatable_presupuestos');
	    var urlPresupuestos = "{{ route('presupuestos.index') }}";

	    $datatablePresupuestos.DataTable({
            ajax: {
                url: urlPresupuestos,
                type: "GET",
                dataSrc: '',
				data: function ( d ) {
					d.fecha_inicio = $("#fecha_inicio").val();

					if (d.fecha_inicio != '' || d.fecha_inicio.trim().lenght > 0 ) {
						d.fecha_fin = $("#fecha_fin").val();
					}
					d.local_id = ($("#local").val() == 0) ? null: $("#local").val();
				},
            },
            columns: [
                {data: 'user_id', visible: false},
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
						var $btnPdf = ''

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

        				return $btnEditar + $btnEditarDiseno + $btnPdf+ $btnVisor + $btnEliminar;
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

		$('#fecha_inicio').change(function(e) {
			console.log('cambios');
			var $this = $(this);
			var fechaInicio = $this.val().trim();

			if ( fechaInicio.lenght == 0 || fechaInicio == '' ) {
				$('#fecha_fin').attr('disabled', 'disabled');
			} else {
				$('#fecha_fin').removeAttr('disabled');
			}
		})

		$('#refresh').click(function(e) {
            e.preventDefault();
            $('#fecha_inicio').val('');
            $('#fecha_fin').val('');
			var $local = $('#local');
            var options = $local.html();
			$local.html(options);
        });

        $('#filtro').click(function(e) {
            e.preventDefault();
			$datatablePresupuestos.DataTable().ajax.reload();
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
