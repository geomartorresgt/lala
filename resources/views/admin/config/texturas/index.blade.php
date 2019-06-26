@extends('admin.layouts.app')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Listado de Texturas
                </div>
                <div class="card-body">
                	@permission('texturas_crear')
            	        <div class="row m-0 mb-2 ">
            	            <div class="col-md-12 text-right">
            	                <a href="{{ route('texturas.create') }}" class="btn btn-info btn-effect-ripple text-white">
            	                	<i class="fa fa-plus"></i> 
            	                	Nueva
            	                </a>
            	            </div>
            	        </div>
        	        @endpermission
        	        <div class="row">
	                    @include('admin.config.texturas._table')
	                </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
@push('js')
	@include('admin.config.texturas.js.table')
@endpush
