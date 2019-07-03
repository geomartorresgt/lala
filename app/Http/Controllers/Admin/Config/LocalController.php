<?php

namespace App\Http\Controllers\Admin\Config;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CreateLocalesRequest;

class LocalController extends Controller
{

    public function __construct() {
        $this->middleware("permission:local_ver");
        $this->middleware("permission:local_crear")->only("create", "store");
        $this->middleware("permission:local_editar")->only("edit", "update");
        $this->middleware("permission:local_eliminar")->only("destroy");
        View::share('titulo', "Locales");
    }
    
    public function index(Request $request)
    {
        $locales = Local::all();
        if ($request->ajax()) {
            return response()->json($locales);
        }

        return view("admin.config.locales.index")->withLocales($locales);
    }

    public function create()
    {
        $local = new Local();
        return view("admin.config.locales.create")->withLocal($local);
    }

    public function store(CreateLocalesRequest $request)
    {
        try{
            DB::beginTransaction();
            Local::create( $request->all() );
            DB::commit();
            $mensaje = "El Local fue creado con éxito.";
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
                return redirect()->route('locales.index');
            }
        }
    }

    public function show(Local $local)
    {
        return redirect()->route('locales.index');
    }

    public function edit(Local $local)
    {
        return view('admin.config.locales.edit')->withLocal($local);
    }

    public function update(Request $request, Local $local)
    {
        try{
            DB::beginTransaction();
            $local->actualizar( $request->all() );
            DB::commit();
            $mensaje = "Los datos del local han sido actualizado.";
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
                return redirect()->route('locales.index');
            }
        }
    }

    public function destroy(Request $request, Local $local)
    {
        try {
            $local->delete();
            $mensaje = "Ha sido eliminado con éxito.";
            $success = true;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $success = false;
        } catch(\Illuminate\Database\QueryException $e){
            $mensaje = "No es posible eliminarlo por que hay registros relacionados";
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

            return redirect()->route('locales.index');
        }
    }
    
}
