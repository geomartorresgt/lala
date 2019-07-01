<script>
  $(document).ready(function() {
    $('#categorias').change(function(e) {
      var $this = $(this);
      var $categorias = $('.content-categorias .row');
      if ($this.val() == '') {
        $categorias.fadeIn();
        return;
      }
      $categorias.fadeOut();
      $categorias.each( (index, element) => {
        var $item = $(element);
        if ($item.attr('id') == `row_categoria_${$this.val()}` && $this.val() != '' ) 
          $item.fadeIn();
      });
      
    });
  });
</script>