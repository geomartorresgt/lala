<?php

namespace App\Http\Controllers\Web;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventosController extends Controller
{
    public function index()
    {
        $eventos = Evento::latest()->paginate(6);

        return view('web.eventos.index')
                ->withEventos($eventos);
    }
}
