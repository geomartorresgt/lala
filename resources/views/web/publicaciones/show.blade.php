@extends('web.layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Image Header -->
        <div class="row mt-5 justify-content-center">
            <img class="img-fluid rounded mb-4" src="{{$publicacion->banner_url}}" alt="">
        </div>

        <div class="row">
            <h1 class="">{{$publicacion->titulo}}</h1>
        </div>

        <!-- Marketing Icons Section -->
        <div class="row">
            {!! $publicacion->contenido !!}
            {{-- {{dd($publicacion->contenido)}} --}}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
