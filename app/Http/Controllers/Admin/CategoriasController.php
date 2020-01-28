<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categorias = Categoria::all();
            return response()->json($categorias);
        }
        
        return view('admin.categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create')
                ->withCategoria(new Categoria());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoriaRequest $request)
    {
        try {
            DB::beginTransaction();
            $categoria = Categoria::create($request->only('nombre', 'clave', 'descripcion', 'inicio', 'icono'));
            DB::commit();

            flash('La categoría ha sido creada correctamente.')->success();
            return redirect()->route('categorias.index');
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
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit')
                ->withCategoria($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            DB::beginTransaction();
            $categoria->update($request->only('nombre', 'clave'));
            DB::commit();

            flash('Categoría actualizada correctamente.')->success();
            return redirect()->route('categorias.index');
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
    public function destroy(Categoria $categoria)
    {
        try {
            DB::beginTransaction();
            $categoria->delete();

            DB::commit();
            flash('Categoría eliminada correctamente.')->success();
            return redirect()->route('categorias.index');
        } catch (\Throwable $th) {
            DB::rollback();
            flash($e->getMessage())->error();
        }
        return back();
    }
}
