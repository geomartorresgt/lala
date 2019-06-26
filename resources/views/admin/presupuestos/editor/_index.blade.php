@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('editor/css/app.css')}}">
@endpush
<div id='interfaces' class='card'>
    <div id="floorplanner" class='front'>
        <div id="floorplanner-controls">
            <button id="btn_save_design" class="btn btn-sm btn-default" title="Guardar Diseño">
                <span class="glyphicon glyphicon-floppy-disk"></span>
            </button>
            <button id="draw" class="btn btn-sm btn-default" title="Draw New Walls">
                <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button id="delete" class="btn btn-sm btn-default" title="Eliminar">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
            <button id="capture_canvas_editor" class="btn btn-sm btn-default" title="Capturar Imagen">
                <span class="glyphicon glyphicon-camera"></span>
            </button>
            <button id="editar_datos" class="btn btn-sm btn-default" title="Editar Datos" type="button">
                <span class="glyphicon glyphicon-pencil"></span> Datos					
            </button>
            <div class="content_muebles"></div>
        </div>
        <div class="btn-hint ">Press the "Esc" key to stop drawing
            walls</div>
        <canvas id="floorplanner-canvas"></canvas>
    </div>

    <div id="viewer" class='back'>
        <div id="main-controls">
            <button id="btn_save_design" class="btn btn-sm btn-default" title="Guardar Diseño">
                <span class="glyphicon glyphicon-floppy-disk"></span>
            </button>
            <button id="capture_canvas_editor" class="btn btn-sm btn-default" title="Capturar Imagen">
                <span class="glyphicon glyphicon-camera"></span>
            </button>
            <button id="editar_datos" class="btn btn-sm btn-default" title="Editar Datos" type="button">
                <span class="glyphicon glyphicon-pencil"></span> Datos					
            </button>
        </div>
        <div class="content_muebles"></div>
    </div>
</div>
<div id='interface-controls'>
    <button id="showFloorPlan" class="btn btn-sm btn-default active" title="Edit 2D floorplan">
        <span class="glyphicon glyphicon-move"></span> Floor Plan
    </button>
    <button id="showDesign" class="btn btn-sm btn-default" title="Edit 3D floorplan">
        <span class="glyphicon glyphicon-move"></span> 3D
    </button>
    <div class="btn-group-vertical" id='viewcontrols'>
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
            <a class="btn btn-default bottom" href="#" id="rightview" title="Show side view (right)">
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
    <button id="showAddItems" class="btn btn-sm btn-default" data-toggle="modal" data-target="#add-items-modal"
        title="Add/Remove items in 3D">
        <span class="glyphicon glyphicon-plus"></span>
    </button>
    <button id="showFirstPerson" class="btn btn-sm btn-default" title="Walk through">
        <span class="glyphicon glyphicon-eye-open"></span>
    </button>
</div>

<!-- Add Items -->
<div class="modal fade" id="add-items-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Lineas</h4>
            </div>
            <div class="modal-body">
                <div id="add-items" class="panel-group">
                    <!--
                    <div id="floor-items" class="panel panel-default">
                        <div id="floor-items-header" class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#add-items" href="#floor-items-body">
                                    Floor Items
                                </a>
                            </h4>
                        </div>
                        <div id="floor-items-body" class="panel-collapse collapse in inventory-content">	
                            <div class="row panel-body" id="floor-items-wrapper">
                                
                            </div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Presupuesto -->
<div class="modal fade" id="modalPresupuesto" tabindex="-1" role="dialog" aria-labelledby="modalPresupuestoLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalPresupuestoLabel">Nuevo Presupuesto</h4>
            </div>
            <div class="modal-body">
                <form id="form_presupuesto">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre Cliente:</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">E-mail Cliente:</label>
                        <input type="text" class="form-control" id="email_cliente" name="email_cliente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Teléfono Cliente:</label>
                        <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Cedula Cliente:</label>
                        <input type="text" class="form-control" id="cedula_cliente" name="cedula_cliente">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Fecha:</label>
                        <input type="text" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Descuento:</label>
                        <input type="text" class="form-control" id="descuento" name="descuento">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_cuardar_presupuesto" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.3/dat.gui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{asset('editor/js/bp3djs.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('editor/js/items.js')}}"></script>
    <script type="text/javascript" src="{{asset('editor/js/items_gltf.js')}}"></script>
    <script type="text/javascript" src="{{asset('editor/js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('editor/js/capture-camara.js')}}"></script>
    
@endpush