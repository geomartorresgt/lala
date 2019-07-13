<?php

namespace App\Http\Controllers\Admin\Config\DatosMasivos;

use Exception;
use App\Models\Local;
use App\Models\LocalMueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function __construct() {
        View::share('titulo', "Datos Masivos");
    }
    
    public function index(Request $request)
    {
        $locales = Local::all();
        return view("admin.config.datos-masivos.index")->withLocales($locales);
    }

    public function download(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('local') ) {
            $requestAll = $request->all();
            $requestAll['local_id'] = $user->local_id;
            $request->merge($requestAll);
        }

        $request->validate([
            'local_id' => 'required',
        ]);

        $localId = $request->local_id;
        $local = Local::find($localId);

        Excel::create($local->nombre, function($excel) use ($localId) {
 
            $excel->sheet('Muebles', function($sheet) use ($localId) {
                $muebles = LocalMueble::exportMueblesLocal($localId);
                $sheet->fromArray($muebles);
            });
        })->export('xls');
    }

    public function upload(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('local') ) {
            $requestAll = $request->all();
            $requestAll['local_id'] = $user->local_id;
            $request->merge($requestAll);
        }

        $request->validate([
            'local_id' => 'required',
            'archivo' => 'required'
        ]);

        try {
            $localId = $request->local_id;
            $path = $request->file('archivo')->getRealPath();
            $data = Excel::load($path)->get();
            $array = [];
    
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr = [];
                    foreach ($value as $i => $val) {
                        switch ($i) {
                            case 'id':
                                $arr['id'] = (int) $val;
                                break;
                            case 'precio':
                                $arr['precio'] = (float) $val;
                                break;
                            
                            default:
                                break;
                        }
                    }
                    $array[] = $arr;
                }
            }

            foreach ($array as $key => $value) {
                $localMueble = LocalMueble::firstOrNew(['mueble_id' => $value['id'], 'local_id' => $localId ]);
                $localMueble->precio = $value['precio'];
                if(!$localMueble->exists && $localMueble->precio == 0){
                } else {
                    $localMueble->save();
                }
            }

            flash('Se cargaron los datos de manera exitosa.')->success(); 
        } catch (Exception $e) {
            flash('Error al cargar los datos.')->error(); 
        }
        return back();
    }
    
}
