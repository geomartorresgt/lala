<?php

namespace App\Http\Controllers\Admin\Config\DatosMasivos;

use App\Models\Local;

use Illuminate\Http\Request;
use App\Exports\MueblesExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelController extends Controller
{

    public function __construct() {
        // $this->middleware("permission:local_ver");
        // $this->middleware("permission:local_crear")->only("create", "store");
        // $this->middleware("permission:local_editar")->only("edit", "update");
        // $this->middleware("permission:local_eliminar")->only("destroy");
        View::share('titulo', "Datos Masivos");
    }
    
    public function index(Request $request)
    {
        $locales = Local::all();
        return view("admin.config.datos-masivos.index")->withLocales($locales);
    }

    public function download(Request $request)
    {

        // dd($request->local_id );
        return Excel::download(new MueblesExport( Local::find($request->local_id) ), 'muebles.xlsx');

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');
    }

    public function upload(Request $request)
    {
        
    }

    
    
}
