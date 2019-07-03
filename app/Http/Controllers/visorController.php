<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class visorController extends Controller
{
    public function show(Request $request, $file)
    {
        return view("visor.show",['file' => $file]);
    }

}
