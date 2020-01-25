<aside class="aside-menu" style="overflow:auto !important">
	<div class="container-fluid overflow-auto">
		<div class="row overflow-auto">
			<div class="col-12 overflow-auto">
				<h2 class="text-dark">Perfil</h2>
				<form action="{{url('/admin/config/usuariosSide')}}" method="post"
				      class="form-control-borderless frm-perfil-user overflow-auto" autocomplete="off">
				    {{ csrf_field() }}
				    <input type="hidden" name="_method" value="PUT">
				    <input type="hidden" name="_inicio" value="0">
				    <input type="hidden" name="habilitar" value="0">

				    
				    <div class="form-group">
				        <div class="col-xs-12 text-center">
				            <img src="{{url(Auth::user()->foto_perfil)}}" id="img_perfil" alt="" class="img-thumbnail" data-toggle="modal" data-target="#cambiar_foto">
				            <label class="label_img_perfil" data-toggle="modal" data-target="#cambiar_foto" 
				            >Cambiar imagen</label>
				        </div>
				    </div>
				    
				    <div class="form-group">
				        <label for="profile-nombre">Nombres:</label>
				        <input type="text" id="profile-nombre" name="nombres" class="form-control"
				               value="{{ Auth::user()->nombres }}">
				    </div>
				    <div class="form-group">
				        <label for="profile-apellido">Apellidos:</label>
				        <input type="text" id="profile-apellido" name="apellidos" class="form-control"
				               value="{{ Auth::user()->apellidos }}">
				    </div>
				    <div class="form-group">
				        <label for="profile-email">Email:</label>
				        <input type="email" id="profile-email" name="email" class="form-control"
				               value="{{ Auth::user()->email }}">
				               <input id="anterior_email" name="anterior_email" class="form-control" type="hidden" value="{{ Auth::user()->email }}">
				    </div>
				    <div class="form-group">
				        <label for="profile-telefono">Teléfono:</label>
				        <input type="text" id="profile-telefono" name="telefono" class="form-control"
				               value="{{ Auth::user()->telefono }}">
				    </div>
				    <div class="form-group">
				        <label for="profile-password">Nueva Contraseña:</label>
				        <input type="password" id="profile-password" name="password" class="form-control">
				    </div>
				    <div class="form-group">
				        <label for="profile-password-confirm">Confirmar Contraseña:</label>
				        <input type="password" id="profile-password-confirm" name="repClave"
				               class="form-control">
				    </div>
				    <div class="form-group remove-margin">
				        <div class="col-xs-6">
				            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>

				            <button class="btn btn-danger aside-menu-toggler" type="button" data-toggle="aside-menu-lg-show">
					            Cerrar
					        </button>
				        </div>
				    </div>
				</form>
				<br><br><br>
			</div>
		</div>
	</div>


	
</aside>