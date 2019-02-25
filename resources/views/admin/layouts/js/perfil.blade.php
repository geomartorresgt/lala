<script>
	$(document).ready(function(){
		var $frmPerfilUser = $(".frm-perfil-user");
        var form_cambiar_foto = $("#form_cambiar_foto");
        var image_editor_perfil = $(".image-editor-perfil");



		$frmPerfilUser.on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $frmPerfilUser.attr('action'),
                type: $frmPerfilUser.attr('method'),
                data: $frmPerfilUser.serialize(),
                datatype: 'json',
                success: function (respuesta) {
                    if (respuesta.success) {
                        toastr.success(respuesta.mensaje);
                        App.sidebar('close-sidebar-alt');
                        $(".text-nombre").html($("#profile-nombre").val() + ' '+ $("#profile-apellido").val());
                        $frmPerfilUser[0].reset();
                    }
                    else {
                        toastr.error(respuesta.error);
                    }
                },
                error: function (e) {
                    $.each(e.responseJSON.errors, function (index, element) {
                        if ($.isArray(element)) {
                            toastr.error(element[0]);
                        }
                    });
                }
            });
        });

		function readURL(input, preview) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$(preview)
					.attr('src', e.target.result);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}

		image_editor_perfil.cropit({
			exportZoom: 1.25,
			imageBackground: true,
			imageBackgroundBorderWidth: 20,
			imageState: {
				src: "{{url(Auth::user()->foto_perfil)}}",
			},
	    });

	    $('.image-editor-perfil .rotate-cw').click(function() {
	        image_editor_perfil.cropit('rotateCW');
	    });

	    $('.image-editor-perfil .rotate-ccw').click(function() {
	        image_editor_perfil.cropit('rotateCCW');
	    });

		form_cambiar_foto.on('submit', function (e) {
            e.preventDefault();
                var form = $('#form_cambiar_foto')[0];
                var imageData =image_editor_perfil.cropit('export',{
                                    type: 'image/jpeg',
                                    quality: .9,
                                    originalSize:true
                                    });
                $('.image-editor-perfil .hidden-image-data').val(imageData);

                var formData = new FormData(form);
                $.ajax({
                    url: form_cambiar_foto.attr('action'),
                    type: form_cambiar_foto.attr('method'),
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                success: function (respuesta) {
                    if (respuesta.success) {
                        toastr.success(respuesta.mensaje);
                        //App.sidebar('close-sidebar-alt');
                        $(".avatar-foto").attr('src', respuesta.foto_url);
                        $("#img_perfil").attr('src', respuesta.foto_url);
                        $("#cambiar_foto").modal('hide');
                    }
                    else {
                        toastr.error(respuesta.error);
                    }
                },
                error: function (e) {
                    $.each(e.responseJSON.errors, function (index, element) {
                        if ($.isArray(element)) {
                            toastr.error(element[0]);
                        }
                    });
                }
            });
        });

	});
</script>