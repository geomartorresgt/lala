@if ($local->exists)
<form id="form-local" class="form-horizontal form-label-left" action="{{ route('locales.update', $local->id) }}" method="POST" enctype="multipart/form-data">
    	{{ method_field('PUT') }}
@else
<form id="form-local" class="form-horizontal form-label-left" action="{{ route('locales.store') }}" method="POST" enctype="multipart/form-data">
@endif
    {{ csrf_field() }}

    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="nombre">Logo</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="logo_url" name="logo_url" aria-describedby="logo_url">
                <label class="custom-file-label" for="logo_url">Logo</label>
            </div>
        </div>
        <div class="form-group col-12 col-md-6">        
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control col-12 col-md-6"  value="{{ old('nombre', $local->nombre) }}" required>
        </div>

        <div class="form-group col-12 col-md-6">        
            <label for="telefono_contacto">Teléfono</label>
            <input type="text" id="telefono_contacto" name="telefono_contacto" class="form-control col-12 col-md-6"  value="{{ old('telefono_contacto', $local->telefono_contacto) }}" required>
        </div>

        <div class="form-group col-12 col-md-6">        
            <label for="direccion">Dirección</label>
            <textarea name="direccion" id="direccion" class="form-control" rows="2">{{ old('direccion', $local->direccion) }}</textarea>
        </div>
    </div>
    
</form>