<script>
    $(function () {
      $('#cargar-imagen').cropit();
// Handle rotation
$('.rotate-cw').click(function() {
  $('#cargar-imagen').cropit('rotateCW');
});
$('.rotate-ccw').click(function() {
  $('#cargar-imagen').cropit('rotateCCW');
});

$(".filePush").on("click",function(){
    $("#file-i").click();
})
      var formulario_nuevo_user = $("#formulario_nuevo_user");
              var image_editor_user = $('.image-editor-user');
        var hidden_image_data_user = $(".hidden-image-data");

      formulario_nuevo_user.on('submit', function (e) {
            e.preventDefault();
                var form = $('#formulario_nuevo_user')[0];
             var imageData = $('#cargar-imagen').cropit('export',{
                                    type: 'image/jpeg',
                                    quality: .9,
                                    originalSize:true
                                    });
          hidden_image_data_user.val(imageData);

                var formData = new FormData(form);
                $.ajax({
                    url: formulario_nuevo_user.attr('action'),
                    type: formulario_nuevo_user.attr('method'),
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                success: function (respuesta) {
                    if (respuesta.success) {
                        window.location.href = "{{url('admin/config/usuarios')}}";
                    }
                    else {
                        toastr.error(respuesta.error);
                    }
                },
                error: function (e) {
                    console.log(e);
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