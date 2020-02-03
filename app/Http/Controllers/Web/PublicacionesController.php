<?php

namespace App\Http\Controllers\Web;

use App\Publicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicacionesController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::latest()->paginate(9);

        return view('web.publicaciones.index')
                ->withPublicaciones($publicaciones);
    }

    public function show($slug)
    {
        $publicacion = Publicacion::FindBySlug($slug)->first();

        if ($publicacion === null) abort(404);

        return view('web.publicaciones.show')
                ->withPublicacion($publicacion);
    }
}
