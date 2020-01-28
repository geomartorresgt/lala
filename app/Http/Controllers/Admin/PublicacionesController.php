<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Categoria;
use App\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publicaciones = Publicacion::all();
            return response()->json($publicaciones);
        }
        
        return view('admin.publicaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.publicaciones.create')
                ->withPublicacion(new Publicacion())
                ->withCategorias($categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePublicacionRequest $request)
    {
        try {
            DB::beginTransaction();
            $publicacion = Publicacion::create($request->only('titulo', 'contenido', 'banner'));
            if($request->categorias)
                $publicacion->addCategorias($request->categorias);
            DB::commit();

            flash('La publicación ha sido creada correctamente.')->success();
            return redirect()->route('publicaciones.index');
        } catch (Exception $e) {
            DB::rollback();

            flash($e->getMessage())->error();
            return back()->withInput(Input::all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion $publicacion)
    {
        $categorias = Categoria::all();
        return view('admin.publicaciones.edit')
                ->withPublicacion($publicacion)
                ->withCategorias($categorias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublicacionRequest $request, Publicacion $publicacion)
    {
        try {
            DB::beginTransaction();
            $publicacion->actualizar( $request->all() );

            if($request->categorias)
                $publicacion->addCategorias($request->categorias);

            DB::commit();

            flash('Publicación actualizada correctamente.')->success();
            return redirect()->route('publicaciones.index');
        } catch (Exception $e) {
            DB::rollback();
            flash($e->getMessage())->error();
        }
        
        return back()->withInput(Input::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion $publicacion)
    {
        try {
            DB::beginTransaction();
            $publicacion->delete();

            DB::commit();
            flash('Publicación eliminada correctamente.')->success();
            return redirect()->route('publicaciones.index');
        } catch (\Throwable $th) {
            DB::rollback();
            flash($e->getMessage())->error();
        }
        return back();
    }
}
