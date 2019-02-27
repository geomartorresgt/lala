<script type="text/javascript">
	var $formUsuario = $('#form-usuario');
	var urlFotoPerfil = "{{ $usuario->foto_perfil }}";
	var data = {
		allowDragNDrop: false,
	};

	// $formUsuario.on('submit', function(e){
	// 	e.preventDefault();
	// 	console.log('a ver');
	// });

	if (urlFotoPerfil) {
		console.log('url', urlFotoPerfil);
		// data.exportZoom = 1.25;
		data.imageBackground = true;
		data.imageBackgroundBorderWidth = 20;
		data.imageState = {
            src: urlFotoPerfil,
        };
        console.log('data: ', data);
	};
	$('#image-cropper').cropit(data);
	$('.download-btn').click(function() {
		var imageData = $('#image-cropper').cropit('export');
		window.open(imageData);
	});

	$('#cambiar_foto').change(function(e){
		if (e.target.checked) {
			$('center').removeClass('d-none');
		} else {
			$('center').addClass('d-none');
		}
	})


</script>