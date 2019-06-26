<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoriaMuebleRequest;
use App\Http\Requests\UpdateCategoriaMuebleRequest;
use App\Models\CategoriaMueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class CategoriaMuebleController extends Controller
{
    public function __construct() {
        $this->middleware("permission:categorias_muebles_ver");
        $this->middleware("permission:categorias_muebles_crear")->only("create", "store");
        $this->middleware("permission:categorias_muebles_editar")->only("edit", "update");
        $this->middleware("permission:categorias_muebles_eliminar")->only("destroy");
        View::share('titulo', "Categorias Mueble");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoriamuebles = CategoriaMueble::with(['muebles'])->get();
        if ($request->ajax()) {
            return response()->json($categoriamuebles);
        }

        return view("admin.config.categoriasMuebles.index")->withCategoriaMuebles($categoriamuebles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriaMueble = new CategoriaMueble();
        return view("admin.config.categoriasMuebles.create")->withCategoriaMueble($categoriaMueble);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoriaMuebleRequest $request)
    {
        $success = false;
        try{
            DB::beginTransaction();
            $categoriaMueble = CategoriaMueble::create(
                $request->all()
            );
            
            DB::commit();
            $mensaje = "La categoria fue creado con éxito.";
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
                return redirect()->route('categorias-muebles.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaMueble $categoriamueble
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaMueble $categoriamueble)
    {
        return redirect()->route('categorias-muebles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaMueble  $categoriamueble
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaMueble $categoriasMueble)
    {
        return view('admin.config.categoriasMuebles.edit')->withCategoriaMueble($categoriasMueble);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaMueble  $categoriamueble
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaMuebleRequest $request, CategoriaMueble $categoriasMueble)
    {
        $success = false;
        try{
            DB::beginTransaction();
            $categoriasMueble->update(
                $request->all()
            );
            DB::commit();
            $mensaje = "Los datos de la categoria han sido actualizado.";
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
                return redirect()->route('categorias-muebles.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaMueble  $categoriamueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CategoriaMueble $categoriasMueble)
    {
        $success = false;
        try {
            $categoriasMueble->delete();
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

            return redirect()->route('categorias-muebles.index');
        }
    }
}