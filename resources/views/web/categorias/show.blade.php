@extends('web.layouts.app')

@section('content')
    <div class="container">
        <img class="img-fluid rounded mb-4" src="{{asset('web/images/banner-salud.jpg')}}" alt="{{$categoria->nombre}}">
        <h1 class="mt-4 mb-3">Fundacion LALA
            <small>{{$categoria->nombre}}</small>
        </h1>

        {!!$categoria->descripcion!!}

        @forelse($items as $key => $item)
            <div class="row border-bottom py-3">
                <div class="col-lg-6 order-1 order-lg-{{$key % 2? 1 : 2}}">
                    <img class="img-fluid rounded mb-4" src="{{asset('web/images/700x450.png')}}" alt="">
                </div>

                <div class="col-lg-6 order-2 order-lg-{{$key % 2? 2 : 1}}">
                    <h2>{{$item->titulo}}</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere.</p>
                </div>
                <hr>
            </div>
        @empty
            <h4 class="text-center my-5">No hay publicaciones de {{$categoria->nombre}}</h4>
        @endforelse

        
    </div>
@endsection
