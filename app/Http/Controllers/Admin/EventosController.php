<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\UpdateEventoRequest;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $eventos = Evento::all();
            return response()->json($eventos);
        }
        
        return view('admin.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eventos.create')
                ->withEvento(new Evento());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventoRequest $request)
    {
        try {
            DB::beginTransaction();
            $evento = Evento::create($request->only('banner', 'titulo', 'descripcion', 'fecha'));
            DB::commit();

            flash('El evento ha sido creada correctamente.')->success();
            return redirect()->route('eventos.index');
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
    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit')
                ->withEvento($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventoRequest $request, Evento $evento)
    {
        try {
            DB::beginTransaction();
            $evento->update($request->only('banner', 'titulo', 'descripcion', 'fecha'));
            DB::commit();

            flash('Evento actualizado correctamente.')->success();
            return redirect()->route('eventos.index');
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
    public function destroy(Evento $evento)
    {
        try {
            DB::beginTransaction();
            $evento->delete();

            DB::commit();
            flash('Evento eliminado correctamente.')->success();
            return redirect()->route('evento.index');
        } catch (\Throwable $th) {
            DB::rollback();
            flash($e->getMessage())->error();
        }
        return back();
    }
}
