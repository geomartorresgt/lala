<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Blueprint JS - Floorplan</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link href="{{asset('editor/css/app.css')}}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
<script	src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.3/dat.gui.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="{{ asset('editor/js/bp3djs.min.js')}}"></script>
<script src="{{ asset('editor/js/items.js')}}"></script>
<script src="{{ asset('editor/js/items_gltf.js')}}"></script>
<script src="{{ asset('editor/js/app.js')}}"></script>
</head>

<body>
	<div id='interfaces' class='card'>
		<div id="floorplanner" class='front'>
			<div id="floorplanner-controls">
				<a href="#"
					class="btn btn-default btn-sm glyphicon glyphicon-floppy-disk"
					id="new2d" title="New Layout"></a>
				<button id="move" class="btn btn-sm btn-default" title="Move Walls">
					<span class="glyphicon glyphicon-move"></span>
				</button>
				<button id="draw" class="btn btn-sm btn-default"
					title="Draw New Walls">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
				<button id="delete" class="btn btn-sm btn-default"
					title="Delete Walls">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
				<button id="help2d" class="btn btn-sm btn-default"
					title="Tips&#10;Shift Key: Snap To Axis&#10;ESC: Stop drawing walls">
					<span class="glyphicon glyphicon-info-sign"></span>
				</button>
				<button id="capture_canvas_editor" class="btn btn-sm btn-default"
					title="Capturar Imagen">
					<span class="glyphicon glyphicon-camera"></span>
				</button>
			</div>
			<div class="btn-hint ">Press the "Esc" key to stop drawing
				walls</div>
			<canvas id="floorplanner-canvas"></canvas>
		</div>

		<div id="viewer" class='back'>
			<div id="main-controls">
				<a href="#"
					class="btn btn-default btn-sm glyphicon glyphicon-floppy-disk"
					id="new" title="New Layout"></a> <a href="#"
					class="btn btn-default btn-sm glyphicon glyphicon-floppy-save"
					id="saveFile" title="Save Layout"></a> <a
					class="btn btn-sm btn-default btn-file glyphicon glyphicon-floppy-open">
					<input type="file" class="hidden-input" id="loadFile">
				</a> 
				<a href="#" class="btn btn-default btn-sm glyphicon glyphicon-asterisk"	id="saveMesh" title="Save Scene as a mesh"></a>
				<a href="#" class="btn btn-default btn-sm glyphicon glyphicon-export"	id="saveGLTF" title="Save Scene as a GLTF"></a>
			</div>
		</div>
	</div>
	<div id='interface-controls'>
		<button id="showFloorPlan" class="btn btn-sm btn-default active"
			title="Edit 2D floorplan">
			<span class="glyphicon glyphicon-move"></span> Floor Plan
		</button>
		<button id="showDesign" class="btn btn-sm btn-default"
			title="Edit 3D floorplan">
			<span class="glyphicon glyphicon-move"></span> 3D
		</button>
		<div class="btn-group-vertical" id='viewcontrols' >
			<div class="btn btn-sm btn-default">	
		            <a class="btn btn-default bottom" href="#" id="leftview" title="Show side view (left)">
		              <span class="glyphicon glyphicon glyphicon-object-align-left"></span>
		            </a>
		            <span class="btn-group-vertical">
		              <a class="btn btn-default" href="#" id="topview" title="Show top view">
		                <span class="glyphicon glyphicon glyphicon-object-align-horizontal"></span>
		              </a>
		              <a class="btn btn-default" href="#" id="isometryview" title="Show 3d view">
		                <span class="glyphicon glyphicon glyphicon-inbox"></span>
		              </a>
		              <a class="btn btn-default" href="#" id="frontview" title="Show front view">
		                <span class="glyphicon glyphicon glyphicon-object-align-vertical"></span>
		              </a>                
		            </span>
		            <a class="btn btn-default bottom" href="#" id="rightview" title="Show side view (right)" >
		              <span class="glyphicon glyphicon glyphicon-object-align-right"></span>
		            </a>
	        </div>
	        <button id="showSwitchCameraMode" class="btn btn-sm btn-default" title="Switch Camera ortho/perspective">
				<span class="glyphicon glyphicon-camera"></span>			
			</button>
			<button id="showSwitchWireframeMode" class="btn btn-sm btn-default" title="Switch wireframe mode">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>			
        </div>
		<button id="showAddItems" class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-items-modal" title="Add/Remove items in 3D">
			<span class="glyphicon glyphicon-plus"></span>
		</button>
		<button id="showFirstPerson" class="btn btn-sm btn-default" title="Walk through">
			<span class="glyphicon glyphicon-eye-open"></span>
		</button>		
	</div>

	<!-- Add Items -->
	<div class="modal fade" id="add-items-modal" role = "dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Lineas</h4>
		        </div>
		        <div class="modal-body">
		          <div id="add-items" class="panel-group">
					<div id="floor-items" class="panel panel-default">
						<div id="floor-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#floor-items-body">Anza</a></h4></div>
						<div id="floor-items-body" class="panel-collapse collapse in inventory-content">	
							<div class="row panel-body" id="anza">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
					<div id="wall-items" class="panel panel-default">
						<div id="wall-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#wall-items-body">Cerejeira brillo</a></h4></div>
						<div id="wall-items-body" class="panel-collapse collapse inventory-content">	
							<div class="row panel-body" id="cerejeira-brillo">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
					<div id="in-wall-items" class="panel panel-default">
						<div id="in-wall-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#in-wall-items-body">Cerejeira mate</a></h4></div>
						<div id="in-wall-items-body" class="panel-collapse collapse inventory-content">	
							<div class="row panel-body" id="cerejeira-mate">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
					<div id="in-wall-items" class="panel panel-default">
						<div id="in-wall-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#in-wall-items-body">Imbuia</a></h4></div>
						<div id="in-wall-items-body" class="panel-collapse collapse inventory-content">	
							<div class="row panel-body" id="imbuia">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
					<div id="in-wall-floor-items" class="panel panel-default">
						<div id="in-wall-floor-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#in-wall-floor-items-body">StyloNobre -  clásica</a></h4></div>
						<div id="in-wall-floor-items-body" class="panel-collapse collapse inventory-content">	
							<div class="row panel-body" id="stylonoble-clasica">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
					<div id="on-floor-items" class="panel panel-default">
						<div id="on-floor-items-header" class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#add-items" href="#on-floor-items-body">StyloNoble - noble</a></h4></div>
						<div id="on-floor-items-body" class="panel-collapse collapse inventory-content">	
							<div class="row panel-body" id="stylonoble-noble">
								<!-- Items added here by items.js -->
							</div>
						</div>
					</div>
				
				</div>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			var $btnCaptureEditor = $('#capture_canvas_editor');
			console.log('boton');
			console.log($btnCaptureEditor);

			$btnCaptureEditor.click(function(event){
				event.preventDefault();
				enviarCapture();
			});

			function caputurarImagenCanvas() {
				var $canvas = document.getElementById('floorplanner-canvas');
				var image = new Image();
				image.id = "pic"
				image.src = $canvas.toDataURL();

				return image;
			}

			function enviarCapture(){
				var image = caputurarImagenCanvas();
				$.ajax({
					type:'POST',
					url: "{{ route('editor.save_image') }}",
					// headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					data:{name: 'Hola mundo', image: image.src},
					dataType: 'json',
					success:function(data){
						if (data.success) {
							alert(data.mensaje);
						}
					}
				});
			}
		});
	</script>
</body>
</html>