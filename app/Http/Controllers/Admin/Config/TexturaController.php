<?php

namespace App\Http\Controllers\Admin\Config;

use App\Models\Textura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class TexturaController extends Controller
{
    public function __construct() {
        $this->middleware("permission:texturas_ver");
        $this->middleware("permission:texturas_crear")->only("create", "store");
        $this->middleware("permission:texturas_editar")->only("edit", "update");
        $this->middleware("permission:texturas_eliminar")->only("destroy");
        View::share('titulo', "Texturas");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $texturas = Textura::all();
        if ($request->ajax()) {
            return response()->json($texturas);
        }

        return view("admin.config.texturas.index")->withTexturas($texturas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $textura = new Textura();
        $tipoTextura = Textura::TIPO_TEXTURA;
        return view("admin.config.texturas.create")
                    ->withTextura($textura)
                    ->withTipoTextura($tipoTextura);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            Textura::create( $request->all() );
            DB::commit();
            $mensaje = "la Textura fue creada con éxito.";
            $success = true;
        } catch (Exception $e) {
            DB::rollback();
            $mensaje = $e->getMessage();
            $success = false;
        }

        if ($request->ajax()) {
            if(!$success){
                return response()->json([
                    'success' => true,
                    'mensaje' => $mensaje,
                ]);
            } else {
                return response()->json([
                    'error' => $mensaje,
                ]);
            }
        } else {
            if(!$success){
                flash($mensaje)->error();
                return back()->withInput(Input::all());
            } else {
                flash($mensaje)->success();
                return redirect()->route('texturas.index');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mueble $mueble
     * @return \Illuminate\Http\Response
     */
    public function show(Textura $textura)
    {
        return redirect()->route('texturas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Textura $textura)
    {
        $tipoTextura = Textura::TIPO_TEXTURA;
        return view('admin.config.texturas.edit')
                    ->withTextura($textura)
                    ->withTipoTextura($tipoTextura);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Textura $textura)
    {
        $success = false;
        try{
            DB::beginTransaction();
            $textura->actualizar(
                $request->all()
            );
            DB::commit();
            $mensaje = "Los datos de la textura han sido actualizados.";
            $success = true;
        } catch (Exception $e) {
            DB::rollback();
            $mensaje = $e->getMessage();
            $success = false;
        }
        
        if ($request->ajax()) {
            if(!$success){
                return response()->json([
                    'success' => 'true',
                    'mensaje' => $mensaje,
                ]);
            } else {
                return response()->json([
                    'error' => $mensaje,
                ]);
            }
        } else {
            if(!$success){
                flash($mensaje)->error();
                return back()->withInput(Input::all());
            } else {
                flash($mensaje)->success();
                return redirect()->route('texturas.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Textura $textura)
    {
        $success = false;
        try {
            $textura->delete();
            $mensaje = "Ha sido eliminado con éxito.";
            $success = true;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $success = false;
        } catch(\Illuminate\Database\QueryException $e){
            $mensaje = "No es posible eliminarla por que hay registros relacionados";
            $success = false;
        }

        if ($request->ajax()) {
            if(!$success){
                return response()->json([
                    'success' => 'true',
                    'mensaje' => $mensaje,
                ]);
            } else {
                return response()->json([
                    'error' => $mensaje,
                ]);
            }
        } else {
            if(!$success){
                flash($mensaje)->error();
            } else {
                flash($mensaje)->success();
            }

            return redirect()->route('texturas.index');
        }
    }

}