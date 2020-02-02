<?php

namespace App\Http\Controllers\Web;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventosController extends Controller
{
    public function index()
    {
        $eventos = Evento::latest()->paginate(9);

        return view('web.eventos.index')
                ->withEventos($eventos);
    }

    public function show($slug)
    {
        $evento = Evento::findBySlug($slug)->first();

        if ($evento === null) abort(404);

        return view('web.eventos.show')
                ->withEvento($evento);
    }
}
