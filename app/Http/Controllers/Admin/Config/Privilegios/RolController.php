<?php

namespace App\Http\Controllers\Admin\Config\Privilegios;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class RolController extends Controller
{
    public function __construct()
    {
        // $this->middleware("permission:privilegios_ver");
        // $this->middleware("permission:privilegios_crear")->only("create", "store");
        // $this->middleware("permission:privilegios_editar")->only("edit", "update");
        // $this->middleware("permission:privilegios_eliminar")->only("destroy");
        // View::share('titulo', "Roles");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Rol::all();
        if ($request->ajax()) {
            return response()->json($roles);
        }

        return view('admin.config.privilegios.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permiso::all();
        return view('admin.config.privilegios.roles.create')->withPermisos($permisos)->withRol(new Rol());
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

        $slug_rol = str_slug($request->name, '_');

        $rol = Rol::where("name", $slug_rol)->first();
        if ($rol) {
            flash('El nombre del rol no se encuentra disponible')->error();
            return Redirect::back()->withInput($request->all());
        }

        $rol = new Rol();
        $rol->fill($request->except('permisos'));
        $rol->name = $slug_rol;
        $rol->save();

        $rol->perms()->sync($request->permisos);
        flash('Rol Creado Correctamente')->success();
        return redirect('admin/config/privilegios/roles');
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
        $rol = Rol::findOrFail($id);
        $pre_permisos = Permiso::all();
        $permisos = [];
        foreach ($pre_permisos as $key => $permiso) {
            $check = DB::table('permiso_rol')->where('permiso_id',$permiso->id)->where('rol_id',$id)->count();
            if($check == 1){
                $permiso->checked = 1;
            }else{
                $permiso->checked = 0;
            }
            $permisos[] = $permiso;
        }
        return view('admin.config.privilegios.roles.edit', compact('rol','permisos'));
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
        $rol = Rol::findOrFail($id);
        $validation = [
            'name' => 'required',
        ];
        $this->validate($request, $validation);

        $slug_rol = str_slug($request->name, '_');

        if ($rol->name != $slug_rol) {
            $role = Rol::where("name", $slug_rol)->first();
            if ($role) {
                flash('El nombre del rol no se encuentra disponible')->error();
                return Redirect::back()->withInput($request->all());
            }
        }
        $rol->fill($request->except('permisos'));
        $rol->name = $slug_rol;
        $rol->save();

        $rol->perms()->sync($request->permisos);
        
        flash('El rol ha sido actualizado con exito')->success();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);
        $mensaje = null;

        if($rol->perms->count()){
        	$mensaje = "El rol posee permisos activos";

        	if ($request->ajax()) {
	        	return response()->json([
	                'success' => false,
	                'mensaje' => $mensaje,
	            ]);	
        	}

        	flash($mensaje)->error();
        	return redirect()->route('roles.index');
        }

        if ($rol->delete()) {
        	$mensaje = "El rol ha sido eliminado con exito";	
        }

    	if ($request->ajax()) {
        	return response()->json([
                'success' => true,
                'mensaje' => $mensaje,
            ]);	
    	}

		flash($mensaje)->success();
		return redirect()->route('roles.index');
    }
}
