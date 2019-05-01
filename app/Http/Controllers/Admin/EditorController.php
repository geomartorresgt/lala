<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Editor;
use App\Models\Mueble;


class EditorController extends Controller
{
    public function index()
    {
        return view('admin.editor.index');
    }
    
    public function saveImage(Request $request)
    {
        $result = Editor::guardarCaptura($request->image);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'mensaje' => 'Captura realizada con exito.',
            ]);
        }

        return response()->json([
            'success' => false,
            'mensaje' => 'Ha ocurrido un error al realizar la captura de imagen.',
        ]);
    }

    public function iframe()
    {
        return view('admin.editor.editor');
    }

    public function getMuebles(Request $request)
    {
        $muebles = Mueble::all();
        if ($request->ajax()) {
            return response()->json($muebles);
        }

        return response()->json($muebles);
    }
    
}
