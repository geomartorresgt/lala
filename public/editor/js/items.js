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
});
