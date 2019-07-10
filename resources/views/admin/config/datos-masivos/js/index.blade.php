<script>
    $(document).ready(function() {
        var urlUpload = "{{ route('excel.upload') }}"
        var urlDownload = "{{ route('excel.download') }}"

        $('#realizar').click(function(e) {
            e.preventDefault();
            var $accion = $('#accion');
            var valorAccion = $accion.val();
            var $form = $accion.closest('form');
            var $local = $('#local');
            var valorLocal = $local.val();
            var $archivo = $('#archivo')
            var ruta = '';
            var token = $('meta[name=csrf-token]').attr('content');

            if (valorLocal == '') {
                alert('Debe seleccionar un local');
                return;
            }

            if (valorAccion == '') {
                alert('Debe seleccionar una acción a realizar')
                return;
            }

            if (valorAccion == '1' && $archivo[0].files.length === 0 ) {
                alert('Debe cargar un archivo')
                return;
            }

            if (valorAccion == '1') { // cargar data
                $form.attr('action', urlUpload);
                ruta = urlUpload;
            } else if (valorAccion == '2') { // descargar data
                $form.attr('action', urlDownload);
                ruta = urlDownload;
            } else {
                return;
            }

            $form.submit();

            return;
        })

        $('#accion').change(function(e) {
            var $this = $(this);
            var value = $this.val();
            var $archivo = $('#archivo')
            var $divArchivo = $archivo.closest('.form-group');

            if (value == '1') {
                if($divArchivo.hasClass('d-none')){
                    $divArchivo.removeClass('d-none')
                    $archivo.removeAttr('disabled')
                }
            } else {
                if(!$divArchivo.hasClass('d-none')){
                    $divArchivo.addClass('d-none')
                    $archivo.attr('disabled', 'disabled')
                }
            }
        });
    })
</script>