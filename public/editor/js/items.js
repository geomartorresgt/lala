// add items to the "Add Items" tab

$(document).ready(function() {
  var muebles = [];
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

  getAllCategories()
  function getAllCategories() {
    var url = window.location.href.replace('editor/', 'admin/categorias-muebles/editor');
    $.ajax({
      type:'GET',
      url: url,
      success:function(data){
        contentModalCategories(data);
        setDataMuebles(data)
      }
    });
  }

  $('body').on('keyup', '#search_muebles', function(event){
    var $this = $(this);
    var searchMuebles = [];
    const texto = $this.val().toLowerCase().trim();

    if (texto == '' || texto.length == 0) {
      $('#search_items').fadeOut()
      $('#add-items').fadeIn();
      return;
    }

    $('#add-items').fadeOut();//.delay(500).fadeIn();
    searchMuebles = muebles.filter( local => {
      return local.mueble.codigo.toLowerCase().includes(texto) ||
              local.mueble.nombre.toLowerCase().includes(texto) ||
              local.mueble.dimensiones.toLowerCase().includes(texto);
    });


    let renderItems = ''; 
    searchMuebles.forEach( local => (
      renderItems += templateItemMuebles(local)
    ));

    if (searchMuebles.length == 0) {
      $('#search_items').html(`
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12">
                <h6 class="text-center">No hay coincidencias.</h6>
              </div>
            </div>
          </div>
        `
      ).fadeIn();

      return
    }

    $('#search_items').html(`
        <div class="container-fluid">
          <div class="row">
            ${renderItems}
          </div>
        </div>
      `
    ).fadeIn();
  });

  function setDataMuebles(categories) {
    var categorias = [];
    for (var key in categories) {
      categorias.push({
        nombre: key,
        muebles: categories[key]
      })
    }
  
    categorias.map(category => {
      category.muebles.forEach( mueble => {
        muebles.push(mueble);
      });
    });
    
  }

  function contentModalCategories(categories) {
    var categorias = [];
    for (var key in categories) {
      categorias.push({
        nombre: key,
        muebles: categories[key]
      })
    }

    $('#add-items').html(
      categorias.map(category => templateItemAcordeon(category) )
    );
  }

  function templateItemAcordeon(category) {
    const title = category.nombre.toLowerCase().replace(' - ', '-').replace(' ', '-');
    let renderItems = ''; 
    category.muebles.forEach( mueble => (
      renderItems += templateItemMuebles(mueble)
    ));
    
    return `
      <div id="${title}-items" class="panel panel-default">
        <div id="${title}-items-header" class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#add-items" href="#${title}-items-body" class="collapsed">
              ${category.nombre}
            </a>
          </h4>
        </div>
        <div id="${title}-items-body" class="panel-collapse collapse inventory-content">
          <div class="panel-body" id="${title}-items-wrapper">
            <div class="container-fluid" style="padding-right: 0px; padding-left: 0px;">
              <div class="row">
                ${renderItems}
              </div>
            </div>
          </div>
        </div>
      </div>
      `;
  }

  function templateItemMuebles(localMueble) {
    const modelformat = '';
    const mueble = localMueble.mueble;
    return `
      <div class="col-sm-4">
        <a class="thumbnail add-item" model-name="${mueble.nombre}*${mueble.id}" model-url="${mueble.object_js}" model-type="${mueble.tipo_mueble}" ${modelformat} >
          <img src="${mueble.foto_url}" alt="Add Item" data-dismiss="modal"> 
          ${mueble.nombre.toUpperCase()}
        </a>
      </div>
      `;
  }
});
