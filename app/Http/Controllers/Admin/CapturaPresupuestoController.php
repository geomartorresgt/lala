<?php

namespace App\Http\Controllers\Admin;

use App\Models\CapturasPresupuesto;
use App\Models\Presupuesto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class CapturaPresupuestoController extends Controller{
    
    public function __construct() {
        $this->middleware("permission:capturas_eliminar")->only("destroy");
        View::share('titulo', "Capturas");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Presupuesto $presupuesto)
    {
        if ($request->ajax()) {
            $capturas = $presupuesto->capturas;
            return response()->json($capturas);
        }

        return abort(404);
    }

    public function store(Request $request, Presupuesto $presupuesto)
    {
        try {
            DB::beginTransaction();
            
            $capturasPresupuesto =  CapturasPresupuesto::create([
                'img_url' => $request->image,
                'presupuesto_id' => $presupuesto->id
            ]);

            if (!$capturasPresupuesto) { throw new \Exception("Error.", 1); }

            DB::commit();

            return response()->json([
                'success' => true,
                'mensaje' => 'Captura realizada con exito.',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'mensaje' => 'Ha ocurrido un error al realizar la captura de imagen.',
            ]);
        }
    }


    public function destroy(Request $request, Presupuesto $presupuesto, CapturasPresupuesto $capturasPresupuesto)
    {
        try {
            DB::beginTransaction();

            $capturasPresupuesto->delete();

            return response()->json([
                'success' => true,
            ]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
            ]);
        }
    }
    

}