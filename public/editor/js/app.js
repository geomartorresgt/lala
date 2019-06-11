var blueprint3d = null;
var aGlobal = null;
var anItem = null;
var aWall = null;
var aFloor = null;
var aCameraRange = null;
var gui = null;
var globalPropFolder = null;
var itemPropFolder = null;
var wallPropFolder = null;
var floorPropFolder = null;
var cameraPropFolder = null;
var presupuesto = undefined;
var firstLoad = true;
var dataJson = true;
localStorage.removeItem("editor_cargado");
/*
 * Floorplanner controls
 */

function siPresupuesto(){
	if(typeof presupuesto == "undefined"){
		return false;
	}
	return true;
}

var ViewerFloorplanner = function(blueprint3d) 
{
  var canvasWrapper = '#floorplanner';
  // buttons
  var move = '#move';
  var remove = '#delete';
  var draw = '#draw';

  var activeStlye = 'btn-primary disabled';
  this.floorplanner = blueprint3d.floorplanner;
  var scope = this;
  function init() 
  {
    $( window ).resize( scope.handleWindowResize );
    scope.handleWindowResize();
    
    scope.floorplanner.addEventListener(BP3DJS.EVENT_MODE_RESET, function(mode) 
    {	
      $(draw).removeClass(activeStlye);
      $(remove).removeClass(activeStlye);
      $(move).removeClass(activeStlye);
      if (mode == BP3DJS.floorplannerModes.MOVE) 
      {
				console.log('cambios 5');

          $(move).addClass(activeStlye);
      } 
      else if (mode == BP3DJS.floorplannerModes.DRAW) 
      {
				console.log('cambios 6');
				$(draw).addClass(activeStlye);
      } 
      else if (mode == BP3DJS.floorplannerModes.DELETE) 
      {
				console.log('cambios 7');
          $(remove).addClass(activeStlye);
      }
      
      if (mode == BP3DJS.floorplannerModes.DRAW) 
      {
				console.log('cambios 8');
        $("#draw-walls-hint").show();
        scope.handleWindowResize();
      } 
      else 
      {
				console.log('cambios 9 camabios en el mapa al editar el diseño de arquitectura');
				// cambiosEnEditor(blueprint3d);
        $("#draw-walls-hint").hide();
      }
    });

    $(move).click(function()
    {
			console.log('cambios 10');
      scope.floorplanner.setMode(BP3DJS.floorplannerModes.MOVE);
    });

    $(draw).click(function()
    {
			console.log('cambios 11');
      scope.floorplanner.setMode(BP3DJS.floorplannerModes.DRAW);
    });

    $(remove).click(function()
    {
				console.log('cambios 12');
				scope.floorplanner.setMode(BP3DJS.floorplannerModes.DELETE);
    });
  }

  this.updateFloorplanView = function() {
    scope.floorplanner.reset();
  }

  this.handleWindowResize = function() {
    $(canvasWrapper).height(window.innerHeight - $(canvasWrapper).offset().top);
    scope.floorplanner.resizeView();
  };

	init();
	
	// data = '{"floorplan":{"corners":{"56d9ebd1-91b2-875c-799d-54b3785fca1f":{"x":630.555,"y":-227.58400000000006},"8f4a050d-e102-3c3f-5af9-3d9133555d76":{"x":294.64,"y":-227.58400000000006},"4e312eca-6c4f-30d1-3d9a-a19a9d1ee359":{"x":294.64,"y":232.664},"254656bf-8a53-3987-c810-66b349f49b19":{"x":745.7439999999998,"y":232.664},"11d25193-4411-fbbf-78cb-ae7c0283164b":{"x":1044.7019999999998,"y":232.664},"edf0de13-df9f-cd6a-7d11-9bd13c36ce12":{"x":1044.7019999999998,"y":-105.66399999999999},"e7db8654-efe1-bda2-099a-70585874d8c0":{"x":745.7439999999998,"y":-105.66399999999999}},"walls":[{"corner1":"4e312eca-6c4f-30d1-3d9a-a19a9d1ee359","corner2":"254656bf-8a53-3987-c810-66b349f49b19","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/wallmap_yellow.png","stretch":true,"scale":null}},{"corner1":"254656bf-8a53-3987-c810-66b349f49b19","corner2":"e7db8654-efe1-bda2-099a-70585874d8c0","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/wallmap_yellow.png","stretch":true,"scale":null}},{"corner1":"56d9ebd1-91b2-875c-799d-54b3785fca1f","corner2":"8f4a050d-e102-3c3f-5af9-3d9133555d76","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/wallmap_yellow.png","stretch":true,"scale":null}},{"corner1":"8f4a050d-e102-3c3f-5af9-3d9133555d76","corner2":"4e312eca-6c4f-30d1-3d9a-a19a9d1ee359","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/wallmap_yellow.png","stretch":true,"scale":null}},{"corner1":"254656bf-8a53-3987-c810-66b349f49b19","corner2":"11d25193-4411-fbbf-78cb-ae7c0283164b","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"11d25193-4411-fbbf-78cb-ae7c0283164b","corner2":"edf0de13-df9f-cd6a-7d11-9bd13c36ce12","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/light_brick.jpg","stretch":false,"scale":100}},{"corner1":"edf0de13-df9f-cd6a-7d11-9bd13c36ce12","corner2":"e7db8654-efe1-bda2-099a-70585874d8c0","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"e7db8654-efe1-bda2-099a-70585874d8c0","corner2":"56d9ebd1-91b2-875c-799d-54b3785fca1f","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/wallmap_yellow.png","stretch":true,"scale":null}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{"11d25193-4411-fbbf-78cb-ae7c0283164b,254656bf-8a53-3987-c810-66b349f49b19,e7db8654-efe1-bda2-099a-70585874d8c0,edf0de13-df9f-cd6a-7d11-9bd13c36ce12":{"url":"https://blueprint-dev.s3.amazonaws.com/uploads/floor_wall_texture/file/light_fine_wood.jpg","scale":300}}},"items":[{"item_name":"Full Bed","item_type":1,"model_url":"https://blueprint-dev.s3.amazonaws.com/uploads/item_model/model/39/ik_nordli_full.js","xpos":939.5525544513545,"ypos":50,"zpos":-15.988409993966997,"rotation":-1.5707963267948966,"scale_x":1,"scale_y":1,"scale_z":1,"fixed":false}]}'
  // blueprint3d.model.loadSerialized(data);
};

var mainControls = function(blueprint3d) 
{
	  var blueprint3d = blueprint3d;

	  function newDesign() 
	  {
	    blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":-232.02900000000136,"y":235.20400000000032},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":235.3309999999999,"y":235.20400000000032},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":235.3309999999999,"y":-232.15600000000046},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":-232.02900000000136,"y":-232.15600000000046}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
	  }

	  function loadDesign() 
	  {
	    files = $("#loadFile").get(0).files;
	    var reader  = new FileReader();
	    reader.onload = function(event) {
	        var data = event.target.result;
	        blueprint3d.model.loadSerialized(data);
	    }
	    reader.readAsText(files[0]);
	  }

	  function saveDesign() {
	    var data = blueprint3d.model.exportSerialized();
	    var a = window.document.createElement('a');
	    var blob = new Blob([data], {type : 'text'});
	    a.href = window.URL.createObjectURL(blob);
	    a.download = 'design.blueprint3d';
	    document.body.appendChild(a)
	    a.click();
	    document.body.removeChild(a)
	  }
	  
	  function saveGLTF()
	  {
		  blueprint3d.three.exportForBlender();
	  }
	  
	  function saveGLTFCallback(o)
	  {
		var data = o.gltf;
		var a = window.document.createElement('a');
		var blob = new Blob([data], {type : 'text'});
		a.href = window.URL.createObjectURL(blob);
		a.download = 'design.gltf';
		document.body.appendChild(a);
		a.click();
		document.body.removeChild(a);
	  }
	  
	  function saveMesh() {
		    var data = blueprint3d.model.exportMeshAsObj();
		    var a = window.document.createElement('a');
		    var blob = new Blob([data], {type : 'text'});
		    a.href = window.URL.createObjectURL(blob);
		    a.download = 'design.obj';
		    document.body.appendChild(a)
		    a.click();
		    document.body.removeChild(a)
		  }

	  function init() {
	    $("#new").click(newDesign);
	    $("#new2d").click(newDesign);
	    $("#loadFile").change(loadDesign);
	    $("#saveFile").click(saveDesign);
	    $("#saveMesh").click(saveMesh);
	    $("#saveGLTF").click(saveGLTF);
	    blueprint3d.three.addEventListener(BP3DJS.EVENT_GLTF_READY, saveGLTFCallback);
	  }

	  init();
}

var GlobalProperties = function()
{
	this.name = 'Global';
	//a - feet and inches, b = inches, c - cms, d - millimeters, e - meters
	this.units = {a:false, b:false, c:false, d:false, e:true};	
	this.unitslabel = {a:BP3DJS.dimFeetAndInch, b:BP3DJS.dimInch, c:BP3DJS.dimCentiMeter, d:BP3DJS.dimMilliMeter, e:BP3DJS.dimMeter};
	this.guiControllers = null;
	
	this.setUnit = function(unit)
	{
		for (let param in this.units)
		{
			this.units[param] = false;
		}
		this.units[unit] = true;
		
		BP3DJS.Configuration.setValue(BP3DJS.configDimUnit, this.unitslabel[unit]);
		
		console.log(this.units, this.unitslabel[unit], BP3DJS.Configuration.getStringValue(BP3DJS.configDimUnit));
		
		for (var i in this.guiControllers) // Iterate over gui controllers to update the values
		{
			this.guiControllers[i].updateDisplay();
	    }
	}
	
	this.setGUIControllers = function(guiControls)
	{
		this.guiControllers = guiControls;
	}
}

var CameraProperties = function()
{
	this.ratio = 1;
	this.ratio2 = 1;
	this.locked = false;
	this.three = null;
	
	this.change = function()
	{
		if(this.three)
		{
			this.three.changeClippingPlanes(this.ratio, this.ratio2);
		}
	}
	
	this.changeLock = function()
	{
		if(this.three)
		{
			this.three.lockView(!this.locked);
		}
	}
	
	this.reset = function()
	{
		if(this.three)
		{
			this.three.resetClipping();
		}
	}
}

var ItemProperties = function(gui)
{
	this.name = 'an item';
	this.width = 10;
	this.height = 10;
	this.depth = 10;
	this.fixed = false;
	this.currentItem = null;
	this.guiControllers = null;
	this.gui = gui;
	this.materialsfolder = null;
	this.materials = {};
	this.totalmaterials = -1;
	this.proportionalsize = false;
	this.changingdimension = 'w';
	
	this.setGUIControllers = function(guiControls)
	{
		this.guiControllers = guiControls;
	}
	
	this.setItem = function(item)
	{
		this.currentItem = item;
		if(this.materialsfolder)
		{
			this.gui.removeFolder(this.materialsfolder.name);
		}
		if(item)
		{
			var scope = this;
			var material = item.material;
			this.name = item.metadata.itemName;			
			this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
			this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
			this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());			
			this.fixed = item.fixed;
			this.proportionalsize = item.getProportionalResize();
			
			for (var i in this.guiControllers) // Iterate over gui controllers to update the values
			{
				this.guiControllers[i].updateDisplay();
		    }
			
			this.materialsfolder =  this.gui.addFolder('Materials');
			this.materials = {};
			if(material.length)
			{
				this.totalmaterials = material.length;
				for (var i=0;i<material.length;i++)
				{
					this.materials['mat_'+i] = '#'+material[i].color.getHexString();
					var matname = (material[i].name) ? material[i].name : 'Material '+(i+1);
					var ccontrol = this.materialsfolder.addColor(this.materials, 'mat_'+i).name(matname).onChange(()=>{scope.dimensionsChanged()});
				}
				return;
			}
			this.totalmaterials = 1;
			var matname = (material.name) ? material.name : 'Material 1';
			this.materials['mat_0'] = '#'+material.color.getHexString();
			var ccontrol = this.materialsfolder.addColor(this.materials, 'mat_0').name(matname).onChange(()=>{scope.dimensionsChanged()});
			return;
		}
		this.name = 'None';
		return;
	}
	
	this.dimensionsChanged = function()
	{
		if(this.currentItem)
		{
			var item = this.currentItem;
			
			var ow = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
			var oh = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
			var od = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			
			var h = BP3DJS.Dimensioning.cmFromMeasureRaw(this.height);
			var w = BP3DJS.Dimensioning.cmFromMeasureRaw(this.width);
			var d = BP3DJS.Dimensioning.cmFromMeasureRaw(this.depth);		
			
			this.currentItem.resize(h,w,d);
			
			if( w != ow)
			{
				this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
				this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			}
			
			if( h != oh)
			{
				this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
				this.depth = BP3DJS.Dimensioning.cmToMeasureRaw(item.getDepth());
			}
			
			if( d != od)
			{
				this.width = BP3DJS.Dimensioning.cmToMeasureRaw(item.getWidth());
				this.height = BP3DJS.Dimensioning.cmToMeasureRaw(item.getHeight());
			}		
			for (var i=0;i<this.totalmaterials;i++)
			{
				this.currentItem.setMaterialColor(this.materials['mat_'+i], i);
			}
			
			this.guiControllers.forEach((control)=>{control.updateDisplay()}); // Iterate over gui controllers to update the values
		}
	}
	
	this.proportionFlagChange = function()
	{
		if(this.currentItem)
		{
			this.currentItem.setProportionalResize(this.proportionalsize);
		}	
	}
	
	this.lockFlagChanged = function()
	{
		if(this.currentItem)
		{
			this.currentItem.setFixed(this.fixed);
		}		
	}
	
	this.deleteItem = function()
	{
		if(this.currentItem)
		{
			this.currentItem.remove();
			this.setItem(null);
		}
	}
}

var WallProperties = function()
{
	this.textures = [
		['rooms/textures/wallmap.png', true, 1], ['rooms/textures/wallmap_yellow.png', true, 1], 
		['rooms/textures/light_brick.jpg', false, 50], ['rooms/textures/marbletiles.jpg', false, 300], 
		['rooms/textures/light_brick.jpg', false, 100], ['rooms/textures/light_fine_wood.jpg', false, 300], 
		['rooms/textures/hardwood.png', false, 300]];
	
	this.floormaterialname = 0;
	this.wallmaterialname = 0;
	
	this.forAllWalls = false;
	
	this.currentWall = null;
	this.currentFloor = null;
	
	this.wchanged = function()
	{
		if(this.currentWall)
		{
			this.currentWall.setTexture(this.textures[this.wallmaterialname][0], this.textures[this.wallmaterialname][1], this.textures[this.wallmaterialname][2]);
		}
		if(this.currentFloor && this.forAllWalls)
		{
			this.currentFloor.setRoomWallsTexture(this.textures[this.wallmaterialname][0], this.textures[this.wallmaterialname][1], this.textures[this.wallmaterialname][2]);
		}		
	}
	
	this.fchanged = function()
	{
		if(this.currentFloor)
		{
			this.currentFloor.setTexture(this.textures[this.floormaterialname][0], this.textures[this.floormaterialname][1], this.textures[this.floormaterialname][2]);
		}
	}
	
	
	this.setWall = function(wall)
	{
		this.currentWall = wall;
	}
	
	this.setFloor = function(floor)
	{
		this.currentFloor = floor;
	}
}

function addBlueprintListeners(blueprint3d)
{
	var three = blueprint3d.three;
	
	function wallClicked(wall)
	{
		console.log('cambios 1');
		aWall.setWall(wall);
		aWall.setFloor(null);
		itemPropFolder.close();
		wallPropFolder.open();		
	}
	
	function floorClicked(floor)
	{
		console.log('cambios 2');
		aWall.setFloor(floor);
		aWall.setWall(null);
		itemPropFolder.close();
		wallPropFolder.open();
	}
	
	function itemSelected(item)
	{
		console.log('cambios 3');
		// cambiosEnEditor(blueprint3d);
		anItem.setItem(item);
		itemPropFolder.open();
		wallPropFolder.close();
	}
	function itemUnselected()
	{
		console.log('cambios');
		// showMuebles();
		// cambiosEnEditor(blueprint3d);
		anItem.setItem(undefined);
		itemPropFolder.close();
	}
	
	three.addEventListener(BP3DJS.EVENT_ITEM_SELECTED, function(o){itemSelected(o.item);});
	three.addEventListener(BP3DJS.EVENT_ITEM_UNSELECTED, function(o){itemUnselected();});	
	three.addEventListener(BP3DJS.EVENT_WALL_CLICKED, (o)=>{wallClicked(o.item);});
	three.addEventListener(BP3DJS.EVENT_FLOOR_CLICKED, (o)=>{floorClicked(o.item);});
	three.addEventListener(BP3DJS.EVENT_FPS_EXIT, ()=>{$('#showDesign').trigger('click')});    
// three.skybox.toggleEnvironment(this.checked);
// currentTarget.setTexture(textureUrl, textureStretch, textureScale);
// three.skybox.setEnvironmentMap(textureUrl);
}


function getCameraRangePropertiesFolder(gui, camerarange)
{
	var f = gui.addFolder('Camera Limits');
	var ficontrol = f.add(camerarange, 'ratio', -1, 1).name("Range").step(0.01).onChange(function(){camerarange.change()});
	var ficontrol2 = f.add(camerarange, 'ratio2', -1, 1).name("Range 2").step(0.01).onChange(function(){camerarange.change()});
	var flockcontrol = f.add(camerarange, 'locked').name("Lock View").onChange(function(){camerarange.changeLock()});
	var resetControl = f.add(camerarange, 'reset').name('Reset');
	return f;
	
}

function getGlobalPropertiesFolder(gui, global)
{
	var f = gui.addFolder('Global');
	var ficontrol = f.add(global.units, 'a',).name("Feets'' Inches'").onChange(function(){global.setUnit("a")});
	var icontrol = f.add(global.units, 'b',).name("Inches'").onChange(function(){global.setUnit("b")});
	var ccontrol = f.add(global.units, 'c',).name('Cm').onChange(function(){global.setUnit("c")});
	var mmcontrol = f.add(global.units, 'd',).name('mm').onChange(function(){global.setUnit("d")});
	var mcontrol = f.add(global.units, 'e',).name('m').onChange(function(){global.setUnit("e")});
	global.setGUIControllers([ficontrol, icontrol, ccontrol, mmcontrol, mcontrol]);
	
	return f;
}

function getCarbonSheetPropertiesFolder(gui, carbonsheet, globalproperties)
{
	console.log('CARBON SHEET ', carbonsheet, carbonsheet.x);
	var f = gui.addFolder('Carbon Sheet');
	var url = f.add(carbonsheet, 'url').name('Url');
	var width = f.add(carbonsheet, 'width').name('Real Width').max(1000.0).step(0.01);
	var height = f.add(carbonsheet, 'height').name('Real Height').max(1000.0).step(0.01);
	var proportion = f.add(carbonsheet, 'maintainProportion').name('Maintain Proportion');
	var x = f.add(carbonsheet, 'x').name('Move in X');
	var y = f.add(carbonsheet, 'y').name('Move in Y');
	
	var ax = f.add(carbonsheet, 'anchorX').name('Anchor X');
	var ay = f.add(carbonsheet, 'anchorY').name('Anchor Y');
	var transparency = f.add(carbonsheet, 'transparency').name('Transparency').min(0).max(1.0).step(0.05);
	carbonsheet.addEventListener(BP3DJS.EVENT_UPDATED, function(){
		url.updateDisplay();
		width.updateDisplay();
		height.updateDisplay();
		x.updateDisplay();
		y.updateDisplay();
		ax.updateDisplay();
		ay.updateDisplay();
		transparency.updateDisplay(width);
	});
	
	globalproperties.guiControllers.push(width);
	globalproperties.guiControllers.push(height);
	return f;
}

function getItemPropertiesFolder(gui, anItem)
{
	var f = gui.addFolder('Current Item');
	var inamecontrol = f.add(anItem, 'name');
	var wcontrol = f.add(anItem, 'width', 0.1, 1000.1).step(0.1);
	var hcontrol = f.add(anItem, 'height', 0.1, 1000.1).step(0.1);
	var dcontrol = f.add(anItem, 'depth', 0.1, 1000.1).step(0.1);
	var pcontrol = f.add(anItem, 'proportionalsize').name('Maintain Size Ratio');
	var lockcontrol = f.add(anItem, 'fixed').name('Locked in place');
	var deleteItemControl = f.add(anItem, 'deleteItem').name('Delete Item');
	
	function changed()
	{
		anItem.dimensionsChanged();
	}	
	
	function lockChanged()
	{
		anItem.lockFlagChanged();
	}	
	
	function proportionFlagChanged()
	{
		anItem.proportionFlagChange();
	}
	
	wcontrol.onChange(changed);
	hcontrol.onChange(changed);
	dcontrol.onChange(changed);
	pcontrol.onChange(proportionFlagChanged);
	lockcontrol.onChange(lockChanged);
	
	
	anItem.setGUIControllers([inamecontrol, wcontrol, hcontrol, dcontrol, pcontrol, lockcontrol, deleteItemControl]);
	
	return f;
}

function getWallAndFloorPropertiesFolder(gui, aWall)
{
	var f = gui.addFolder('Wall and Floor');	
	var wcontrol = f.add(aWall, 'wallmaterialname', {Grey: 0, Yellow: 1, Checker: 2, Marble: 3, Bricks: 4}).name('Wall');
	var fcontrol = f.add(aWall, 'floormaterialname', {'Fine Wood': 5, 'Hard Wood': 6}).name('Floor');
	var multicontrol = f.add(aWall, 'forAllWalls').name('All Walls In Room');
	function wchanged()
	{
		aWall.wchanged();
	}
	
	function fchanged()
	{
		aWall.fchanged();
	}	
	
	wcontrol.onChange(wchanged);
	fcontrol.onChange(fchanged);
	return f;
}

function datGUI(three, floorplanner)
{
	gui = new dat.GUI();
	aGlobal = new GlobalProperties();
	aCameraRange = new CameraProperties();
	aWall = new WallProperties();
	anItem = new ItemProperties(gui);
	
	aCameraRange.three = three;
	
	globalPropFolder = getGlobalPropertiesFolder(gui, aGlobal);
	carbonPropsFolder = getCarbonSheetPropertiesFolder(globalPropFolder, floorplanner.carbonSheet, aGlobal);
	
	cameraPropFolder = getCameraRangePropertiesFolder(gui, aCameraRange);
	wallPropFolder = getWallAndFloorPropertiesFolder(gui, aWall);
	itemPropFolder = getItemPropertiesFolder(gui, anItem);
}

// function getDataModalPresupuesto() {
// 	var $btnGuardatPresupuesto = $('#btn_cuardar_presupuesto');
// }


function setDataPresupuesto(data){
	presupuesto = data;

	$('#nombre_cliente').val(presupuesto.nombre_cliente);
	$('#email_cliente').val(presupuesto.email_cliente);
	$('#telefono_cliente').val(presupuesto.telefono_cliente);
	$('#cedula_cliente').val(presupuesto.cedula_cliente);
	$('#fecha').val(presupuesto.fecha);
	$('#descuento').val(presupuesto.descuento);	

	dataJson = presupuesto.data_json;
}

function showModalPresupuesto() {
	var $modalPresupuesto = $('#modalPresupuesto');
	var presupuesto_id = localStorage.getItem("presupuesto_id");
	localStorage.setItem("presupuesto_captura_id", presupuesto_id );
	localStorage.setItem("aux_presupuesto_id", presupuesto_id );
	if (presupuesto_id) {
    var urlAjax = window.location.href.replace('editor/', `admin/presupuestos/${presupuesto_id}`);
		$.ajax({
			async: false,
			type: "GET",
			url: urlAjax,
			data: {presupuesto_id: presupuesto_id},
			dataType: 'json',
			success:function(data){
				setDataPresupuesto(data);
				localStorage.removeItem("presupuesto_id");
			}
		});
	}

	if (!siPresupuesto()) {
		$modalPresupuesto.modal('show');
		return true;
	}

	return false;
}

function hideModalPresupuesto() {
	var $modalPresupuesto = $('#modalPresupuesto');
	var data = getDataModalPresupuesto();
	var editorCargado = localStorage.getItem("editor_cargado");
	if (!siPresupuesto()) {
		$modalPresupuesto.modal('show');
	} else {
		if(editorCargado){ return; }
		initAllDocument();
	}
}

function getFormData($form){
	var unindexed_array = $form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		indexed_array[n['name']] = n['value'];
	});

	if (presupuesto.id) {
		indexed_array.id = presupuesto.id;
	}

	return indexed_array;
}

function getDataModalPresupuesto(){
	var $formPresupuesto = $('#form_presupuesto');
	var valido = validarCamposPresupuesto($formPresupuesto);

	if (valido) {
		presupuesto = getFormData($formPresupuesto);
	} else {
		presupuesto = undefined;
	}
}

//Función para comprobar los campos de texto
function validarCamposPresupuesto(obj) {
	var camposRellenados = true;
	obj.find("input").each(function() {
		var $this = $(this);
		if( $this.val().length <= 0 ) {
			camposRellenados = false;
			return false;
		}
	});
	
	if(camposRellenados == false) {
		return false;
	}

	else {
		return true;
	}
}

function loadJsonPresupuesto(blueprint3d) {
	var data_json = dataJson;
	blueprint3d.model.loadSerialized(data_json);
}

function showMuebles() {
	var card = `
		<div style="width: 60px; height: 60px; margin: 0 5px; background-color: red; float: left" >
			<img class="img-responsive" src="http://localhost/trabajo-unigres/public/storage/foto_muebles/5cebea69c1a5c.jpg" alt="Mueble" />
		<div>
	`

	var $contentMuebles = $('.content_muebles');
	console.log('agregar mueble al canvas');
	$contentMuebles.append(card);
}

$(document).ready(function() 
{
	var $collapsePresupuesto = $('#collapsePresupuesto');

	$('.btn_save_design').on('click', function(e){
		e.preventDefault();
		cambiosEnEditor(blueprint3d);

		setTimeout(() => {
			loadDataPresupuesto();
		}, 1000);
	})

	// al abrir el collapse
	$collapsePresupuesto.on('show.bs.collapse', function (e) {
		loadDataPresupuesto()
		toggleMuebles();
	})

	// al cerrar el collapse
	$collapsePresupuesto.on('hide.bs.collapse', function (e) {
		toggleMuebles();
	})

	$('#btn_guardar_presupuesto').on('click', function(e){
		e.preventDefault();
		var urlAjax = '';
		var verboHttp = '';
		var form = $('#form_presupuesto').serializeArray();
		var dataForm = {};

		form.forEach( input => {
			dataForm[input.name] = input.value;
		});

		if(typeof presupuesto === 'undefined'){
			urlAjax = window.location.href.replace('editor/', `admin/presupuestos`);
			verboHttp = 'POST';
			dataForm.data_json = '{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":-232.02900000000136,"y":235.20400000000032},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":235.3309999999999,"y":235.20400000000032},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":235.3309999999999,"y":-232.15600000000046},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":-232.02900000000136,"y":-232.15600000000046}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}';
		} else {
			urlAjax = window.location.href.replace('editor/', `admin/presupuestos/${presupuesto.id}`);
			verboHttp = 'PUT';
			dataForm.data_json = presupuesto.data_json;
		}

		$.ajax({
			url: urlAjax,
			data: dataForm,
			type: verboHttp,
			dataType: "json",
			success: function(data, textStatus, jqXHR){
				if(data.success){
					setDataPresupuesto(data.presupuesto);
					localStorage.setItem("presupuesto_captura_id", presupuesto.id );
					localStorage.setItem("aux_presupuesto_id", presupuesto.id );
					hideModalPresupuesto();
					localStorage.setItem("editor_cargado", true );
					$('#modalPresupuesto').modal('hide');
				}
			}
		});
		
	})

	$('body').on('click', '.editar_datos', function(e){
		e.preventDefault();

		if (presupuesto.id) {
			var urlAjax = window.location.href.replace('editor/', `admin/presupuestos/${presupuesto.id}`);
			
			$.ajax({
				async: false,
				type: "GET",
				url: urlAjax,
				data: {presupuesto_id: presupuesto.id},
				dataType: 'json',
				success:function(data){
					setDataPresupuesto(data)
					$('#modalPresupuesto').modal('show');
				}
			});
		}

	})

	// mostrar el modal nuevamente en caso de que presupuesto siga siendo null
	$('#modalPresupuesto').on('hidden.bs.modal', function (e) {
		hideModalPresupuesto();
	})

	if (showModalPresupuesto()) {
		return
	}

	initAllDocument();
	localStorage.setItem("editor_cargado", true );
});

function initAllDocument(){
	dat.GUI.prototype.removeFolder = function(name) 
	{
		  var folder = this.__folders[name];
		  if (!folder) {
		    return;
		  }
		  folder.close();
		  this.__ul.removeChild(folder.domElement.parentNode);
		  delete this.__folders[name];
		  this.onResize();
	}
	// main setup
	var opts = 
	{
			floorplannerElement: 'floorplanner-canvas',
			threeElement: '#viewer',
			threeCanvasElement: 'three-canvas',
			textureDir: "models/textures/",
			widget: false
	}
	blueprint3d = new BP3DJS.BlueprintJS(opts);  
	var viewerFloorplanner = new ViewerFloorplanner(blueprint3d);
	mainControls(blueprint3d);
	
  	var myhome = '{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":-232.02900000000136,"y":235.20400000000032},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":235.3309999999999,"y":235.20400000000032},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":235.3309999999999,"y":-232.15600000000046},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":-232.02900000000136,"y":-232.15600000000046}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}';
		blueprint3d.model.loadSerialized(myhome);
	
	
	addBlueprintListeners(blueprint3d);
	datGUI(blueprint3d.three, blueprint3d.floorplanner);
	blueprint3d.three.stopSpin();
//	gui.closed = true;
	
	
	$('#showAddItems').hide();
	$('#viewcontrols').hide();
	
	$('.card').flip({trigger:'manual', axis:'x'});  
	$('#showFloorPlan').click(function()
	{
		$('.card').flip(false);
		$(this).addClass('active');
		$('#showDesign').removeClass('active');
		$('#showFirstPerson').removeClass('active');
		$('#showAddItems').hide();
		$('#viewcontrols').hide();
//		gui.closed = true;
		blueprint3d.three.pauseTheRendering(true);
		blueprint3d.three.getController().setSelectedObject(null);
	});
	
	$('#showDesign').click(function()
	{ 
		blueprint3d.model.floorplan.update();
		$('.card').flip(true);
//		gui.closed = false;
		$(this).addClass('active');
		$('#showFloorPlan').removeClass('active');
		$('#showFirstPerson').removeClass('active');	
		
		$('#showAddItems').show();
		$('#viewcontrols').show();
		
		blueprint3d.three.pauseTheRendering(false);
		blueprint3d.three.switchFPSMode(false);
	});
	$('#showFirstPerson').click(function()
	{ 
		blueprint3d.model.floorplan.update();
		$('.card').flip(true);
//		gui.closed = true;
		$(this).addClass('active');
		$('#showFloorPlan').removeClass('active');
		$('#showDesign').removeClass('active');
		
		$('#showAddItems').hide();
		$('#viewcontrols').hide();
		
		blueprint3d.three.pauseTheRendering(false);
		blueprint3d.three.switchFPSMode(true);
	});
	
	$('#showSwitchCameraMode').click(function()
	{
		$(this).toggleClass('active');
		blueprint3d.three.switchOrthographicMode($(this).hasClass('active'));		
	});
	
	$('#showSwitchWireframeMode').click(function()
	{
		$(this).toggleClass('wireframe-active');
		blueprint3d.three.switchWireframe($(this).hasClass('wireframe-active'));		
	});
	
	$('#topview, #isometryview, #frontview, #leftview, #rightview').click(function(){
		blueprint3d.three.switchView($(this).attr('id'));
	});
	
	$("#add-items").on('mousedown', ".add-item", function(e) {
		var modelUrl = $(this).attr("model-url");
		var itemType = parseInt($(this).attr("model-type"));
		var itemFormat = $(this).attr('model-format');
		var metadata = {
			itemName: $(this).attr("model-name"),
			resizable: true,
			modelUrl: modelUrl,
			itemType: itemType,
			format: itemFormat,
		}
		
		if([2,3,7,9].indexOf(metadata.itemType) != -1 && aWall.currentWall)
		{
			var placeAt = aWall.currentWall.center.clone();
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt, edge: aWall.currentWall});
		}
		else if(aWall.currentFloor)
		{
			var placeAt = aWall.currentFloor.center.clone();
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata, null, null, null, false, {position: placeAt});
		}
		else
		{
			blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
		}
	});

	if(presupuesto.id){
		loadJsonPresupuesto(blueprint3d);
	}
}

function cambiosEnEditor(blueprint3d) {
	var data = JSON.parse(blueprint3d.model.exportSerialized());
	const muebles = data.items.map( mueble => mueble.item_name.split('*')[1] )

	var auxPresupuesto = clone(presupuesto);
	auxPresupuesto.data_json = data;
	auxPresupuesto.id_muebles = muebles;

	if (Object.compare(auxPresupuesto, presupuesto)) {
		return
	} else {
		presupuesto = clone(auxPresupuesto);
	}

	guardarPresupuesto();
}

function guardarPresupuesto() {
	var url = window.location.href.replace('editor/', `admin/presupuestos`);
	var type = 'POST';
	var presupuesto_id = presupuesto.id;

	if (presupuesto_id) {
		type = 'PUT'
		url = `${url}/${presupuesto_id}`;
	} else {
		type = 'POST'
	}

	var auxPresupuesto = clone(presupuesto);

	auxPresupuesto.data_json = JSON.stringify(auxPresupuesto.data_json);

	$.ajax({
		type: type,
		url: url,
		data: auxPresupuesto,
		dataType: 'json',
		success:function(data){
			if (data.success) {
				presupuesto.id = data.presupuesto_id;
				localStorage.setItem("presupuesto_captura_id", presupuesto.id );
				loadDataPresupuesto();
			}
		}
	});
}

function clone(obj) {
	if (null == obj || "object" != typeof obj) return obj;
	var copy = obj.constructor();
	for (var attr in obj) {
			if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
	}
	return copy;
}

Object.compare = function (obj1, obj2) {
	//Loop through properties in object 1
	for (var p in obj1) {
		//Check property exists on both objects
		if (obj1.hasOwnProperty(p) !== obj2.hasOwnProperty(p)) return false;
 
		switch (typeof (obj1[p])) {
			//Deep compare objects
			case 'object':
				if (!Object.compare(obj1[p], obj2[p])) return false;
				break;
			//Compare function code
			case 'function':
				if (typeof (obj2[p]) == 'undefined' || (p != 'compare' && obj1[p].toString() != obj2[p].toString())) return false;
				break;
			//Compare values
			default:
				if (obj1[p] != obj2[p]) return false;
		}
	}
 
	//Check object 2 for any extra properties
	for (var p in obj2) {
		if (typeof (obj1[p]) == 'undefined') return false;
	}
	return true;
};

function loadDataPresupuesto(){
	const presupuesto_id = localStorage.getItem("aux_presupuesto_id");
	var url = window.location.href.replace('editor/', `admin/presupuestos/${presupuesto_id}`)

	$.ajax({
			type:'GET',
			url: url,
			data:{ presupuesto_id: presupuesto_id },
			dataType: 'json',
			success:function(data){
					if (data.id == presupuesto_id) {
							showPresupuesto(data)
					}
			}
	});

	// toggleMuebles();
}

function showPresupuesto(presupuesto) {
	var $collapsePresupuesto = $('#collapsePresupuesto');
	var $divMuebles = $('.div-muebles');
	
	var $contentMuebles = $divMuebles.find('#content-muebles');
	var $subtotalPresupuesto = $collapsePresupuesto.find('#subtotal_presupuesto');
	var $descuentoPresupuesto = $collapsePresupuesto.find('#descuento_presupuesto');
	var $totalPresupuesto = $collapsePresupuesto.find('#total_presupuesto');
	var data = '';

	$('#nombre_cliente_collapse').html(presupuesto.nombre_cliente);
	$('.fecha_presupuesto').html(presupuesto.fecha);

	// limpiando el collapse
	$contentMuebles.html(data);
	
	data = presupuesto.muebles.map( data => {
		return muebleTemplate(data)
	});

	// add data in collapse
	$contentMuebles.html(data);
	$subtotalPresupuesto.html(`U$S ${presupuesto.subtotal}`);
	$descuentoPresupuesto.html(`U$S ${presupuesto.descuento_dinero}`);
	$totalPresupuesto.html(`U$S ${presupuesto.total}`);

}

function toggleMuebles() {
	var $divMuebles = $('.div-muebles');
	var $contentCanvas = $('.content-canvas');
	$divMuebles.toggleClass('show');

	if ($divMuebles.hasClass('show') ) {
			$contentCanvas.removeClass('show-100')
			$contentCanvas.addClass('show-85')
	} else {
			$contentCanvas.removeClass('show-85')
			$contentCanvas.addClass('show-100')
	}

}

function muebleTemplate(data){
	const mueble = data.mueble;
	const local_mueble = data.local_mueble;
	return `
			<div class="col-md-12 text-left border-b-1" style="padding-top: 1rem;">
					<div class="media">
							<div class="media-left">
									<img class="media-object" width="40" src="${mueble.foto_url}" alt="Mueble" >
							</div>
							<div class="media-body">
									<h6 class="media-heading">${mueble.nombre}</h6>
									<p style="margin:0;">${mueble.dimensiones}</p>
									<p style="margin:0;">U$S ${local_mueble.precio}</p>
							</div>
					</div>
			</div>
	`;
}