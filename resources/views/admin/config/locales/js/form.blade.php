<script>
    $(document).ready(function(){
        $('#btn-form').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            $this.attr('disabled','disabled');
            $this.addClass('disabled');

            document.getElementById('form-local').submit();
        });
    });
</script>