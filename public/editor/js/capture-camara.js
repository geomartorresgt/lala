
$(document).ready(function() {
  $('#capture_canvas_editor').click(function(event){
    event.preventDefault();
    var image = caputurarImagenCanvas();
    enviarCapture(image);
  });

  $('#capture_canvas_editor_3d').click(function(event){
    event.preventDefault();
    var $canvas = document.querySelector('#viewer canvas');
    var image = new Image();
    image.src = $canvas.toDataURL();
    enviarCapture(image);
  });

  function caputurarImagenCanvas() {
    var $canvas = document.getElementById('floorplanner-canvas');
    var image = new Image();
    image.src = $canvas.toDataURL();
    return image;
  }

  function enviarCapture(image){
    var presupuesto_id = localStorage.getItem("presupuesto_captura_id");
    var url = window.location.href.replace('editor/', `admin/presupuesto/${presupuesto_id}/capturas-presupuesto`)

    $.ajax({
      type:'POST',
      url: url,
      data:{ image: image.src },
      dataType: 'json',
      success:function(data){
        if (data.success) {
          alert(data.mensaje);
        }
      }
    });
  }
});