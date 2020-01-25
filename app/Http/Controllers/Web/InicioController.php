<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function home()
    {
        return view('web.inicio.home');
    }

    public function conocenos()
    {
        return view('web.inicio.conocenos');
    }
}
