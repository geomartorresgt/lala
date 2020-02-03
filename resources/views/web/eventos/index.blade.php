 @extends('web.layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Eventos
            <!--<small>Subheading</small> -->
        </h1>

        <!-- Image Header -->
        <img class="img-fluid rounded mb-4" src="images/photocall-infantil_133_1_1200x300.jpg" alt="">

        <!-- Marketing Icons Section -->
        <div class="row">
            @foreach($eventos as $evento)
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{asset('web/images/700x400.png')}}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{url('/evento/'.$evento->slug)}}">{{$evento->titulo}}</a>
                            </h4>
                            <p class="card-text">{{$evento->getResumen(200)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $eventos->links() }}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
