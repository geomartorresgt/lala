// add items to the "Add Items" tab

$(document).ready(function() {
  var items = [
 
    {
      "name" : "3",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/3/3.js",
      "type" : "1"
    }, 
    {
      "name" : "4",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/4/4.js",
      "type" : "1"
    }, 
    {
      "name" : "5",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/5/5.js",
      "type" : "1"
    }, 
    {
      "name" : "7",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/7/7.js",
      "type" : "1"
    }, 
    {
      "name" : "8",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/8/8.js",
      "type" : "1"
    }, 
    {
      "name" : "9",
      "image" : "models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
      "model" : "models/js/9/9.js",
      "type" : "1"
    }, 
   /*     
   {
      "name" : "",
      "image" : "",
      "model" : "",
      "type" : "1"
    }, 
    */
  ]


  var modelTypesNum = ["1","2","3","7","8","9"];
  var modelTypesIds = ["floor-items", "wall-items", "in-wall-items", "in-wall-floor-items", "on-floor-items", "wall-floor-items"];
  var itemsDiv = $("#items-wrapper");
  for (var i = 0; i < items.length; i++) 
  {
	var item = items[i];
    itemsDiv = $("#"+modelTypesIds[modelTypesNum.indexOf(item.type)]+"-wrapper");
	var modelformat = (item.format) ?' model-format="'+item.format+'"' : "";
    var html = '<div class="col-sm-4">' + '<a class="thumbnail add-item"' +' model-name="'+ item.name +'"' +' model-url="' +item.model+'"' +' model-type="' +item.type+'"' + modelformat+'>'+'<img src="'+item.image +'" alt="Add Item"  data-dismiss="modal"> '+item.name +'</a></div>';
    itemsDiv.append(html);
  }
});
