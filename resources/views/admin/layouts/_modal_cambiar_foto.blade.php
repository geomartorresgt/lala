<style type="text/css">
.btn-file {
	position: relative;
	overflow: hidden;
}
.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}
</style>
<div class="modal fade" id="cambiar_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cambiar Foto de Perfil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form role="form" enctype="multipart/form-data" action="{{url('/admin/config/cambiarFoto/'.Auth::user()->id)}}" autocomplete="off" method="POST"
	                id="form_cambiar_foto">
	            <div class="modal-body">
	                {{ csrf_field() }}
	                <input type="hidden" name="_method" value="PUT">
	                <input type="hidden" name="_inicio" value="0">
	                <input type="hidden" name="habilitar" value="0">
	                <div class="box-body">
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="row image-editor-perfil">
	                                <div class="col-md-12">
	                                    <center>
	                                    <div class="cropit-preview" src="{{url(Auth::user()->foto_perfil)}}"></div><br><br>
	                                    <div class="rotate">
	                                        <span  class="fa fa-repeat rotate-cw icon-rotate-right"></span>
	                                        <span class="fa fa-repeat rotate-ccw icon-rotate-left"></span>
	                                    </div>
	                                    <span class="fa fa-file-picture-o pic-small"></span>
	                                    <input type="range" class="cropit-image-zoom-input">
	                                    <span class="fa fa-file-picture-o pic-big"></span>
	                                    <input type="hidden" name="foto_perfil" class="hidden-image-data"/><br><br>
	                                    </center>
	                                </div>
                                	<div class="col-md-4 col-md-offset-5 col-xs-offset-4 text-center">
                                	    <span class="btn btn-light btn-file" style="align-content: center;">
                                	        Subir archivo 
                                	        <input class="cropit-image-input" type="file">
                                	    </span>
                                	</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            	<button type="button" class="btn btn-primary">Actualizar</button>
	            </div>
	        </form>
		</div> <!-- modal-content -->
	</div> <!-- modal-dialog -->
</div> <!-- modal -->