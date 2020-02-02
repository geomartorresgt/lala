<?php

namespace App\Http\Controllers\Web;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function home()
    {
        $categorias = Categoria::inicio()->get();
        return view('web.inicio.home')->withCategorias($categorias);
    }

    public function conocenos()
    {
        return view('web.inicio.conocenos');
    }

    
}
