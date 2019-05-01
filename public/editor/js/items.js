// add items to the "Add Items" tab
$(document).ready(function() {
  var items = [ 
    {
      "name" : "AÉREO 0.40 1 PTA. A",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/3a/3.js",
      "type" : "2",
      "cat" : "anza"
    },
    {
      "name" : "AÉREO 0.30 1 PTA. B",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/3b/3.js",
      "type" : "2",
      "cat" : "anza"
    },  
    {
      "name" : "AÉREO BODEGA 0.20BAA/30",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/4a/4.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "AÉREO BODEGA 0.15BAA826",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/4b/4.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "MUEBLE PANELEIRO",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/5/5.js",
      "type" : "2",
       "cat" : "anza"
    }, 
    {
      "name" : "AÉREO MICRO GRANDE",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/7/7.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "AÉREO 0.80 PTA. REBATIBLE VIDRIO",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/8/8.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "AÉREO 0.80 PTRA. REBATIBLE VIDRIO",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/9/9.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "AÉREO TERMINAL",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/10/10.js",
      "type" : "2",
      "cat" : "anza"
    }, 
    {
      "name" : "MUEBLE AÉREO 1.20 3 PTAS.",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/11/11.js",
      "type" : "2",
      "cat" : "anza"
    }, 
   /*     
   {
      "name" : "",
      "image" : "",
      "model" : "",
      "type" : "1",
      "cat" : ""
    }, 
    */
  ]

  getMuebles();
  var modelTypesNum = ["1","2","3","7","8","9"];
  var modelTypesIds = ["floor-items", "wall-items", "in-wall-items", "in-wall-floor-items", "on-floor-items", "wall-floor-items"];
  var itemsDiv = $("#items-wrapper");
  for (var i = 0; i < items.length; i++) 
  {
	  var item = items[i];
    itemsDiv = $("#"+item.cat);
	  var modelformat = (item.format) ?' model-format="'+item.format+'"' : "";
    var html = '<div class="col-sm-4">' + '<a class="thumbnail add-item"' +' model-name="'+ item.name +'"' +' model-url="' +item.model+'"' +' model-type="' +item.type+'"' + modelformat+'>'+'<img src="'+item.image +'" alt="Add Item"  data-dismiss="modal"> '+item.name +'</a></div>';
    itemsDiv.append(html);
  }

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
    var url = window.location.href.replace('editor/', 'admin/editor/save-image')

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

  function mostrarMuebles(muebles) {
    itemsDiv = $("#muebles");
    // itemsDiv.append("<h1>hola mundo<h1>");
    console.log('muebles original: ', muebles)

    muebles.forEach(mueble => {
      console.log('primero: ', mueble);
      var html = `
        <div class="col-sm-4">
          <a class="thumbnail add-item" model-name="AÉREO 0.40 1 PTA. A" model-url="${mueble.object_js}" model-type="2">
            <img src="${mueble.foto_url}" alt="Add Item" data-dismiss="modal"> 
            ${mueble.nombre.toUpperCase()}
          </a>
        </div>
      `;

      itemsDiv.append(html);
    });
  }

  function getMuebles() {
    var url = window.location.href.replace('editor/', 'admin/editor/muebles')
    console.log('la ruda es: ', url);
    $.ajax({
      type:'GET',
      url: url,
      success:function(data){
        console.log('los muebles: ', data);
        mostrarMuebles(data);
      }
    });
  }
});
