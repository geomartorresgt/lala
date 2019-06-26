<script>
    $(document).ready(function(){
        $('#btn-form').click(function(e) {
            e.preventDefault();
            var $this = $(this);

            console.log('guardar...')

            $this.attr('disabled','disabled');
            $this.addClass('disabled');

            document.getElementById('form-mueble').submit();
        });
    });
</script>