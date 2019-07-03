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
	                        	<center>
									<div id="image-cropper-perfil">
										<div class="cropit-preview"></div>
										<input type="range" class="cropit-image-zoom-input" />
										<input type="file" class="cropit-image-input d-none" name="foto_perfil" />
									</div>
									<button type="button" class="btn btn-secondary mt-3" id="subir_foto_perfil">Subir Foto</button>
	                        	</center>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	            	<button type="submit" class="btn btn-primary">Actualizar</button>
	            </div>
	        </form>
		</div> <!-- modal-content -->
	</div> <!-- modal-dialog -->
</div> <!-- modal -->
@push('js')
	@include('admin.layouts.js.perfil')
@endpush