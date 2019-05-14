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

  getAllCategories()
  function getAllCategories() {
    var url = window.location.href.replace('editor/', 'admin/config/categorias-muebles');
    $.ajax({
      type:'GET',
      url: url,
      success:function(data){
        contentModalCategories(data);
      }
    });
  }

  function contentModalCategories(categories) {
    var items = categories.map(category => templateItemAcordeon(category) );
    $('#add-items').html(items);
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

  function templateItemMuebles(mueble) {
    const modelformat = '';
    return `
      <div class="col-sm-4">
        <a class="thumbnail add-item" model-name="${mueble.nombre}" model-url="${mueble.object_js}" model-type="${mueble.orden}" ${modelformat} >
          <img src="${mueble.foto_url}" alt="Add Item" data-dismiss="modal"> 
          ${mueble.nombre.toUpperCase()}
        </a>
      </div>
      `;
  }
});
