<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mueble;
use App\Models\LocalMueble;
use Illuminate\Http\Request;
use App\Models\CategoriaMueble;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateMuebleRequest;
use App\Http\Requests\UpdateMuebleRequest;

class LocalMuebleController extends Controller
{
    public function __construct() {
        $this->middleware("permission:local_mueble_ver");
        $this->middleware("permission:local_mueble_crear")->only("create", "store");
        $this->middleware("permission:local_mueble_editar")->only("edit", "update");
        $this->middleware("permission:local_mueble_eliminar")->only("destroy");
        View::share('titulo', "Mueble");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $localId = auth()->user()->local_id;
        $categoriasMuebles = [];
        if (!$localId) { abort(403); }
            $categoriasMuebles = CategoriaMueble::with('muebles')
                                                ->with(['muebles.localMuebles' => function($q) use ( $localId ) { 
                                                    $q->where('local_id', $localId);
                                                }])
                                                ->get()
                                                ->reject(function($categoria){ 
                                                    return !$categoria->muebles->count();
                                                });
        return view("admin.local_mueble.index")->withCategoriasMuebles($categoriasMuebles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mueble = new Mueble();
        $tipoMueble = Mueble::TIPO_MUEBLE;
        return view("admin.config.muebles.create")->withMueble($mueble)->withTipoMueble($tipoMueble);;
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
            $muebles = LocalMueble::add_muebles($request->muebles);
            DB::commit();
            $mensaje = "El mueble fue creado con éxito.";
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
                return redirect()->route('localMueble.index');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mueble $mueble
     * @return \Illuminate\Http\Response
     */
    public function show(Mueble $mueble)
    {
        return redirect()->route('muebles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Mueble $mueble)
    {
        $tipoMueble = Mueble::TIPO_MUEBLE;
        return view('admin.config.muebles.edit')->withMueble($mueble)->withTipoMueble($tipoMueble);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMuebleRequest $request, Mueble $mueble)
    {
        $success = false;
        try{
            DB::beginTransaction();
            $mueble->actualizar(
                $request->all()
            );
            
            DB::commit();
            $mensaje = "Los datos del mueble han sido actualizado.";
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
                return redirect()->route('muebles.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mueble  $mueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Mueble $mueble)
    {
        $success = false;
        try {
            $mueble->delete();
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

            return redirect()->route('muebles.index');
        }
    }

    public function editor(Request $request)
    {
        if ($request->ajax()) {
            $localId = auth()->user()->local_id;
            if (!$localId) { abort(403); }
            $categoriamuebles = LocalMueble::with('mueble')
                                            ->with('mueble.categoria')
                                            ->where('local_id', $localId )
                                            ->where('precio', '>', 0 )
                                            ->get()
                                            ->groupBy('mueble.categoria.nombre');
            
            return response()->json($categoriamuebles);
        }

        abort(403);
    }

}