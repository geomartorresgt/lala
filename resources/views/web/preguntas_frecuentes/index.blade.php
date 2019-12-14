@extends('web.layouts.app')

@section('content')
   <!-- Page Content -->
   <div class="container">      
        <img class="img-fluid rounded mb-4" src="{{asset('web/images/1200x300.png')}}" alt="">
        <!-- Intro Content -->
        <h1 class="mt-4 mb-3">Preguntas Frecuentes</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>

        <div class="row justify-content-center">
            @foreach ($preguntasFrecuentes as $preguntaFrecuente)
                <div class="col-lg-4 col-sm-6  portfolio-item">
                    <div class="maincontainer">
                        <div class="thecard h-100">
                            <div class="thefront">
                                <h1>{{$preguntaFrecuente->pregunta}}</h1>
                            </div>
                            <div class="theback text-white">
                                <p class="card-text m-3 ">
                                    {{$preguntaFrecuente->respuesta}}
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $preguntasFrecuentes->links() }}
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    
@endsection

@push('js')
@endpush