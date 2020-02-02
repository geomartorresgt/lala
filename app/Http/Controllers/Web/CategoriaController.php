<?php

namespace App\Http\Controllers\Web;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    public function show($slug)
    {
        $categoria = Categoria::with('publicaciones')
                        ->findBySlug($slug)->first();

        if ($categoria === null) {
            abort(404);
        }

        $items = $categoria->publicaciones;

        return view('web.categorias.show')
                ->withCategoria($categoria)
                ->withItems($items);
    }
    
}
