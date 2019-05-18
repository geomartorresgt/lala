<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePresupuestoRequest;
use App\Http\Requests\UpdatePresupuestoRequest;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class PresupuestoController extends Controller
{
    public function __construct() {
        // $this->middleware("permission:presupuestos_ver");
        // $this->middleware("permission:presupuestos_crear")->only("create", "store");
        // $this->middleware("permission:presupuestos_editar")->only("edit", "update");
        // $this->middleware("permission:presupuestos_eliminar")->only("destroy");
        View::share('titulo', "Presupuesto");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $presupuestos = Presupuesto::all();
        if ($request->ajax()) {
            return response()->json($presupuestos);
        }

        return view("admin.presupuestos.index")->withPresupuestos($presupuestos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $presupuesto = new Presupuesto();
        return view("admin.presupuestos.create")->withPresupuesto($presupuesto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePresupuestoRequest $request)
    {
        $success = false;
        try{
            DB::beginTransaction();

            $data = $request->except(['id_muebles']);
            $data['fecha'] = now();
            $data['user_id'] = auth()->user()->id;

            $presupuesto = Presupuesto::create(
                $data
            );

            if ($presupuesto && $request->has('id_muebles')) {
                $presupuesto->addMuebles($request->id_muebles);
            }
            
            DB::commit();
            $mensaje = "El presupuesto fue creado con éxito.";
            $success = true;
        } catch (Exception $e) {
            DB::rollback();
            $mensaje = $e->getMessage();
            $success = false;
        }

        if ($request->ajax()) {
            if($success){
                return response()->json([
                    'success' => true,
                    'mensaje' => $mensaje,
                    'presupuesto_id' => $presupuesto->id,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => $mensaje,
                ]);
            }
        } else {
            if(!$success){
                flash($mensaje)->error();
                return back()->withInput(Input::all());
            } else {
                flash($mensaje)->success();
                return redirect()->route('presupuestos.index');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presupuesto $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Presupuesto $presupuesto)
    {
        if ($request->ajax()) {
            $presupuesto->muebles;
            return response()->json($presupuesto);
        }
        return redirect()->route('presupuestos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuesto $presupuesto)
    {
        return view('admin.presupuestos.edit')->withPresupuesto($presupuesto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresupuestoRequest $request, Presupuesto $presupuesto)
    {
        $success = false;
        try{
            DB::beginTransaction();

            $data = $request->only(['nombre_cliente', 'email_cliente', 'telefono_cliente', 'cedula_cliente', 'fecha', 'descuento', 'data_json']);
            $data['fecha'] = now();
            $data['user_id'] = auth()->user()->id;

            if ($presupuesto->update($data) && $request->has('id_muebles')) {
                $presupuesto->addMuebles($request->id_muebles);
            }

            DB::commit();
            $mensaje = "Los datos del presupuesto han sido actualizado.";
            $success = true;
        } catch (Exception $e) {
            DB::rollback();
            $mensaje = $e->getMessage();
            $success = false;
        }
        
        if ($request->ajax()) {
            if($success){
                return response()->json([
                    'success' => true,
                    'mensaje' => $mensaje,
                    'presupuesto_id' => $presupuesto->id,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => $mensaje,
                ]);
            }
        } else {
            if(!$success){
                flash($mensaje)->error();
                return back()->withInput(Input::all());
            } else {
                flash($mensaje)->success();
                return redirect()->route('presupuestos.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Presupuesto $presupuesto)
    {
        $success = false;
        try {
            $presupuesto->delete();
            $mensaje = "Ha sido eliminado con éxito.";
            $success = true;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $success = false;
        }

        if ($request->ajax()) {
            if($success){
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
            } else {
                flash($mensaje)->success();
            }

            return redirect()->route('presupuestos.index');
        }
    }

    public function misPresupuestos(Request $request)
    {
        $presupuestos = auth()->user()->presupuestos;
        if ($request->ajax()) {
            return response()->json($presupuestos);
        }

        return view("admin.presupuestos.mis_presupuestos")->withPresupuestos($presupuestos);
    }

    public function editDiseno(Presupuesto $presupuesto)
    {
        $presupuesto = new Presupuesto();
        return view("admin.presupuestos.editar_diseno")->withPresupuesto($presupuesto);
    }

    public function reporte(Request $request, $presupuesto_id)
    {
        $presupuesto = Presupuesto::with(['muebles', 'capturas'])->findOrFail($presupuesto_id);
        $reporte = $presupuesto->generarReporte();
        return $reporte;
    }
}