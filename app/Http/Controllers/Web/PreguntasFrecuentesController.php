<?php

namespace App\Http\Controllers\Web;

use App\PreguntaFrecuente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntasFrecuentesController extends Controller
{
    public function index()
    {
        $preguntasFrecuentes = PreguntaFrecuente::paginate(6);

        return view('web.preguntas_frecuentes.index')
                ->withPreguntasFrecuentes($preguntasFrecuentes);
    }
}
