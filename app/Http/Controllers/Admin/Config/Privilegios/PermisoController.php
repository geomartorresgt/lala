<?php

namespace App\Http\Controllers\Admin\Config\Privilegios;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class PermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:privilegios_ver");
        $this->middleware("permission:privilegios_crear")->only("create", "store");
        $this->middleware("permission:privilegios_editar")->only("edit", "update");
        $this->middleware("permission:privilegios_eliminar")->only("destroy");
        View::share('titulo', "Permisos");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permisos = Permiso::all();
        if ($request->ajax()) {
            return response()->json($permisos);
        } 
        return view('admin.config.privilegios.permisos.index')->withPermisos($permisos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.privilegios.permisos.create')->withPermiso(new Permiso());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = [
            'name' => 'required',
        ];

        $this->validate($request, $validation);
        $slug_permiso = str_slug($request->name, '_');
        $permiso = Permiso::where("name", $slug_permiso)->first();
        if ($permiso) {
            flash('El nombre del permiso no se encuentra disponible')->error();
            return back()->withInput($request->all());
        }
        $permiso = new permiso();
        $permiso->fill($request->all());
        $permiso->name = $slug_permiso;
        $permiso->save();
        flash('Permiso Creado Correctamente')->success();
        return redirect()->route('permisos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permiso = Permiso::findOrFail($id);
        return view('admin.config.privilegios.permisos.edit', compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);
        $validation = [
            'name' => 'required',
        ];
        $this->validate($request, $validation);

        $slug_permiso = str_slug($request->name, '_');

        if ($permiso->name != $slug_permiso) {
            $permission = Permiso::where("name", $slug_permiso)->first();
            if ($permission) {
                flash('El nombre del permiso no se encuentra disponible')->error();
                return Redirect::back()->withInput($request->all());
            }
        }
        $permiso->fill($request->all());
        $permiso->save();
        flash('El permiso ha sido creado con exito!')->success();
        return redirect()->route('permisos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $permiso = Permiso::findOrFail($id);
        if($permiso->delete()){
        	$mensaje = "El permiso ha sido eliminado con exito";
        }

        if ($request->ajax()) {
        	return response()->json([
	            'success' => true,
	            'mensaje' => $mensaje,
	        ]);
        }

        flash($mensaje)->success();
        return redirect()->route('permisos.index');
    }
}
