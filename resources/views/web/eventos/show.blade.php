@extends('web.layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Image Header -->
        <div class="row mt-5 justify-content-center">
            <img class="img-fluid rounded mb-4" src="{{$evento->banner_url}}" alt="">
        </div>

        <div class="row">
            <h1 class="">{{$evento->titulo}}</h1>
        </div>

        <!-- Marketing Icons Section -->
        <div class="row">
            {!! $evento->descripcion !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
