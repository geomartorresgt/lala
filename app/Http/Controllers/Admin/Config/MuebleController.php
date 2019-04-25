<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMuebleRequest;
use App\Http\Requests\UpdateMuebleRequest;
use App\Models\Mueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MuebleController extends Controller
{
    public function __construct() {
        $this->middleware("permission:muebles_ver");
        $this->middleware("permission:muebles_crear")->only("create", "store");
        $this->middleware("permission:muebles_editar")->only("edit", "update");
        $this->middleware("permission:muebles_eliminar")->only("destroy");
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
        $muebles = Mueble::all();
        if ($request->ajax()) {
            return response()->json($muebles);
        }

        return view("admin.config.muebles.index")->withMuebles($muebles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mueble = new Mueble();
        return view("admin.config.muebles.create")->withMueble($mueble);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMuebleRequest $request)
    {
        $success = false;
        try{
            DB::beginTransaction();

            // $mueble = new Mueble();
            // $mueble->addDatos($request->all());
            // $mueble->save();

            Mueble::create( $request->all() );
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
        return view('admin.config.muebles.edit')->withMueble($mueble);
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
            $mueble->update(
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
}