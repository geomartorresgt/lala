<?php

namespace App\Http\Controllers\Web;

use App\Categoria;
use App\Publicacion;
use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function home()
    {
        $categorias = Categoria::inicio()->get();
        $eventos = Evento::publicados()->destacados()->limit(3)->get();
        $publicaciones = Publicacion::publicados()->destacados()->limit(3)->get();
        return view('web.inicio.home')
                ->withCategorias($categorias)
                ->withEventos($eventos)
                ->withPublicaciones($publicaciones);
    }

    public function conocenos()
    {
        return view('web.inicio.conocenos');
    }

    
}
