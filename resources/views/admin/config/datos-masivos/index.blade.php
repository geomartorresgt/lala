@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Datos Vasivos
                </div>
                <div class="card-body">
                	<div class="container-fluid row">
                        <div class="col-md-12">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-6 col-md-7">
                                        <div class="form-group">
                                            <label class=" control-label" for="local_id">Locales:</label>
                                            <select id="local" name="local_id" class="form-control" required>
                                                <option value="" selected>- Seleccione el Local -</option>
                                                @foreach($locales as $local)
                                                    <option value="{{ $local->id }}">{{$local->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <div class="form-group">
                                            <label class=" control-label" for="accion">Acción:</label>
                                            <select id="accion" name="accion" class="form-control" required>
                                                <option value="">- Seleccione la Acción a Realizar -</option>
                                                <option value="1">- Carga de data -</option>
                                                <option value="2">- Descarga de data -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-6 col-md-5 offset-md-7 d-none">
                                        <label for="nombre">Archivo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="archivo" name="archivo" aria-describedby="archivo" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            <label class="custom-file-label" for="archivo">Archivo excel</label>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row">            
                                    <div class="col-md-2 offset-md-10">
                                        <div class="form-group text-right">
                                            <button class="btn btn-primary btn-effect-ripple btn-theme" id="realizar" type="button" >Realizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
@push('js')
	@include('admin.config.datos-masivos.js.index')
@endpush
