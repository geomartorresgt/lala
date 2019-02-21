@if ($rol->exists)
<form id="form-rol" class="form-horizontal form-label-left" action={{ route('roles.update',  $rol->id) }} method="POST">
    	{{ method_field('PUT') }}
@else
<form id="form-rol" class="form-horizontal form-label-left" action={{ route('roles.store') }} method="POST">
@endif
    {{ csrf_field() }}

    <div class="form-group">
        <label for="slug">Nombre</label>
        <input type="text" id="slug" name="name" class="form-control" value="{{old("name", $rol->name)}}" required {{-- {{ $rol->exists? 'readonly': '' }} --}}>
    </div>

    <div class="form-group">
        <label for="nombre_rol">Nombre para mostrar</label>
        <input type="text" id="nombre_rol" name="display_name" class="form-control" value="{{old("display_name", $rol->display_name)}}" required>
    </div>

    <div class="form-group">
        <label for="descripcion_rol">Descripcion</label>
        <input type="text" id="descripcion_rol" name="description" class="form-control" value="{{old("description", $rol->description)}}" required>
    </div>
    <div class="form-row form-group">
        <label for="" class="col-md-12 font-weight-bold">Permisos</label>
        @foreach($permisos as $key => $permiso)
            <div class="col-md-6 p-2 pl-0">
                <label for="permiso_{{$permiso->id}}" class="checkbox-inline">
                    <input type="checkbox" id="permiso_{{ $permiso->id }}" name="permisos[]" value="{{ $permiso->id }}"
                    	@if($permiso->checked == 1) checked @endif type="checkbox" id="permiso_{{$permiso->id}}"
                    >
                    <span class="ml-2" >{{$permiso->display_name}}</span>
                </label>
            </div>
        @endforeach
    </div>


</form>