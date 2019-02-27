<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:usuarios_ver")->only("index","show");
        $this->middleware("permission:usuarios_crear")->only("create", "store");
        $this->middleware("permission:usuarios_editar")->only("edit", "update");
        $this->middleware("permission:usuarios_eliminar")->only("destroy");
        View::share('titulo', "Usuarios");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$usuarios = User::all();
        if ($request->ajax()) {
            return response()->json($usuarios);
        }
        
        return view('admin.config.usuarios.index')->withUsuarios($usuarios);
    }

    public function usuariosSide(Request $request)
    {;
        $data= [
            'nombres' => 'required',
            'apellidos' => 'required',
        ];

        $this->validate($request, $data);
        $usuario = User::findOrFail(auth()->user()->id);

		
        if($request->habilitar==true)
        {
            $usuario->estado=true;
            $usuario->save();
            return response()->json([
                'success' => 'true',
                'mensaje' => "Se habilito el usuario correctamente"
            ]);

        }else{
            $data = [
                'nombres' => 'required',
                'apellidos' => 'required'
            ];

            if ($request->password != "") {
                $data['password'] = 'required|same:repClave';
            }

            if ($request->anterior_email != $request->email) {
                $data['email'] = 'required|email|unique:users';
            }

            try {
                $usuario->fill($request->except('repClave', 'rol', 'habilitar','anterior_email','password','foto_perfil', 'cambiar_imagen'));

                if ($request->password != "") {
                    if ($request->password != $request->repClave) {
                        throw new \Exception('Error. Las contraseñas no coinciden. Verifique los datos.');
                    }
                    $usuario->password = bcrypt($request->password);
                }

                $urlfinal="";
                if($request->cambiar_imagen == 1 && $request->_inicio == 1){
                    $this->borrarImagenUsuario($usuario);
                    if($request->input('foto_perfil')){
                        $cover = $request->file('foto_perfil');
					    $extension = $cover->getClientOriginalExtension();
					    $filename = uniqid();
					    Storage::disk('foto_perfil')->put($filename.'.'.$extension,  File::get($cover));
		              	$urlfinal = $filename . '.' . $extension;
                    }
                    $usuario->foto_perfil = $urlfinal;

                    
                }

                $usuario->save();

                $mensaje = "Los datos fueron actualizado con éxito";

                if ($request->ajax()) {
                	return response()->json([
	                    'success' => 'true',
	                    'mensaje' => "Los datos fueron actualizado con éxito"
	                ]);
                }
                flash($mensaje)->success();                
                return redirect()->route('root_path');
            } catch (\Exception $e) {
            	dd('error');
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            } 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        $usuario = new User();
        return view('admin.config.usuarios.create')->withRoles($roles)->withUsuario($usuario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:repClave|min:6',
            'rol' => 'required'
        ]);

        try {
            $urlfinal="";

            if($request->foto_perfil){

              // $foto_perfil = $request->foto_perfil;

              // $ruta = "img/foto_perfil/".uniqid().'.png';
              // Storage::put('public/'.$ruta,  $this->decode_imageCropit($request->input('foto_perfil')));
              // $urlfinal = "/storage/$ruta";




              	$cover = $request->file('foto_perfil');
			    $extension = $cover->getClientOriginalExtension();
			    $filename = uniqid();
			    Storage::disk('foto_perfil')->put($filename.'.'.$extension,  File::get($cover));
              	$urlfinal = $filename . '.' . $extension;
            }

            $user = new User();

            $user->fill($request->except('repClave', 'rol', 'foto_perfil'));
            $user->foto_perfil = $urlfinal;
            $user->password = bcrypt($request->password);

            $user->save();

            if($request->rol){
                $user->roles()->sync([$request->rol]);
            }else{
                $user->roles()->sync([]);
            }

            $mensaje = "El usuario <b>$request->nombres</b> fue creado con éxito";

            if ($request->ajax()) {
	            return response()->json([
	                'success' => true,
	                'mensaje' => $mensaje
	            ]);	
            }

            flash($mensaje)->success();

        } catch (\Exception $e) {
            if ($request->ajax()) {
            	return response()->json([
	                'error' => $e->getMessage()
	            ]);
            }
            flash($e->getMessage())->error();
        }

        return redirect()->route('usuarios.index');
    }

    private function decode_imageCropit($imageCropit){
        $imageCropit = str_replace('data:image/jpeg;base64,', '', $imageCropit);
        $imageCropit = str_replace(' ', '+', $imageCropit);
        return base64_decode($imageCropit);
     }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Rol::all();
        $usuario = User::findOrFail($id);
        return view('admin.config.usuarios.edit', compact('roles','usuario'));
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

        $usuario = User::findOrFail($id);

        if($request->habilitar==true)
        {
            $usuario->estado=true;
            $usuario->save();
            return response()->json([
                'success' => 'true',
                'mensaje' => "Se habilito el usuario correctamente"
            ]);
        }else{
            $data = [
                'nombres' => 'required',
                'apellidos' => 'required'
            ];

            if ($request->password != "") {
                $data['password'] = 'required|same:repClave';
            }

            if ($request->anterior_email != $request->email) {
            	
            	// $data['email'] = 'sometimes|required|email|unique:users';
            	// $data['email'] = 'required|email|max:255|unique:users,email,'. $usuario;
                // $data['email'] = 'required|email|unique:users';
            }

            $this->validate($request, $data); 
            try {
                $usuario->fill($request->except('repClave', 'rol', 'habilitar','anterior_email','password','foto_perfil', 'cambiar_imagen'));

                if ($request->password != "") {
                    $usuario->password = bcrypt($request->password);
                }
                $urlfinal="";


                if($request->cambiar_imagen){
                 	$this->borrarImagenUsuario($usuario);

                	if($request->foto_perfil){
                		// $foto_perfil = $request->foto_perfil;

                		// $ruta = "img/foto_perfil/".uniqid().'.jpg';
                		// Storage::put('public/'.$ruta,  $this->decode_imageCropit($request->input('foto_perfil')));
                		// $urlfinal = "/storage/$ruta";

                		
                		$cover = $request->file('foto_perfil');
					    $extension = $cover->getClientOriginalExtension();
					    $filename = uniqid();
					    Storage::disk('foto_perfil')->put($filename.'.'.$extension,  File::get($cover));
		              	$urlfinal = $filename . '.' . $extension;
                	}
                	$usuario->foto_perfil = $urlfinal;
                }

                $usuario->save();

                if ($request->_inicio == 1) {
                    $usuario->roles()->sync([$request->rol]);
                }

                $mensaje = "Los datos fueron actualizado con éxito";
                if ($request->ajax()) {
	                return response()->json([
	                    'success' => 'true',
	                    'mensaje' => $mensaje
	                ]);
                } 

                flash($mensaje)->success();
                return redirect()->route('usuarios.index');
            } catch (\Exception $e) {
               return response()->json([
                    'error' => $e->getMessage()
                ]);

               if ($request->ajax()) {
	                return response()->json([
	                	'error' => $e->getMessage()
	                ]);
                } 

                flash($e->getMessage())->success();
                return redirect()->route('usuarios.index');
            } 
        } 
    }

    private function borrarImagenUsuario($usuario){
        $fotoU = $usuario->foto_perfil;
        if($fotoU != "" || $fotoU != null){

            $fotoU = str_replace("storage","public",$fotoU);
            Storage::delete($fotoU);
        }
    }

    public function cambiarFoto($user_id, Request $request)
    {
        $usuario = User::findOrFail($user_id);
        try {

            $urlfinal="";
            $this->borrarImagenUsuario($usuario);
            if($request->input('foto_perfil')){
              $foto_perfil = $request->file('foto_perfil');
              $ruta = "img/foto_perfil/".uniqid().'.jpg';
              Storage::put('public/'.$ruta,  $this->decode_imageCropit($request->input('foto_perfil')));
              $urlfinal = "/storage/$ruta";
            }
            $usuario->foto_perfil = $urlfinal;

            $usuario->save();

            return response()->json([
                'success' => 'true',
                'mensaje' => "Los foto de perfil fue actualizado con éxito",
                'foto_url'=>url($usuario->foto_perfil)
            ]);
        } catch (\Exception $e) {
           return response()->json([
                'error' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $usuario = User::findOrFail($id);
        $mensaje = null;
        $success = false;
        $cerrar_sesion = false;
        try {
            $result = $usuario->delete();
            if ($result == 1) {
                $this->borrarImagenUsuario($usuario);
                if ($usuario->id == $user->id) {
                    Auth::logout();
                    $mensaje = "Se ha eliminado correctamente";
			        $success = true;
			        $cerrar_sesion = true;
                }else{
                	$mensaje = "Se ha eliminado correctamente";
			        $success = true;
			        $cerrar_sesion = false;
                }
                
            } else {
            	$success = false;
            	$mensaje = "Error al eliminar el usuario";
		        $cerrar_sesion = false;	
            }
        } catch (\Exception $e) {
            $usuario->estado = 0;
            $usuario->save();

            $success = true;
            $mensaje = "Se ha deshabilitado el usuario correctamente";
	        $cerrar_sesion = false;
        }

        if ($success) {
        	flash($mensaje)->success();
        } else{
        	flash($mensaje)->error();
        }

        return redirect()->route('usuarios.index');
    }
}
