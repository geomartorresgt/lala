<script type="text/javascript">
    $(document).ready(function(){
    	    var form_cambiar_foto = $("#form_cambiar_foto");
    	    var image_editor_perfil = $('#image-cropper-perfil');
    		var urlFotoPerfil = "{{ auth()->user()->foto_perfil }}";
    		var data = {
    			allowDragNDrop: false,
    		};
    		
    		image_editor_perfil.cropit({ 
    			exportZoom: 0,
    			allowDragNDrop: false,
    			imageBackground: true,
    			imageBackgroundBorderWidth: 20,
    			imageState: {
    	            src: urlFotoPerfil,
    	        }

    		});

    		form_cambiar_foto.on('submit', function (e) {
    	        e.preventDefault();
    	            var form = $('#form_cambiar_foto')[0];
    	            var imageData =image_editor_perfil.cropit('export',{
    	                                type: 'image/jpeg',
    	                                quality: .9,
    	                                originalSize:true
    	                                });

    	            $('#image-cropper-perfil .hidden-image-data').val(imageData);

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
    	                    $("#img_perfil").attr('src', respuesta.foto_url);
    	                    $("#cambiar_foto").modal('hide');
    	                }
    	                else {
    	                }
    	            },
    	            error: function (e) {
    	                $.each(e.responseJSON.errors, function (index, element) {
    	                    if ($.isArray(element)) {
    	                    }
    	                });
    	            }
    	        });
    	    });

	    $('#subir_foto_perfil').click(function(e){
			$('input[name="foto_perfil"]').trigger('click');
		});

    });

</script>