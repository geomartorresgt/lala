<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\PreguntaFrecuente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreatePreguntaFrecuenteRequest;
use App\Http\Requests\UpdatePreguntaFrecuenteRequest;

class PreguntasFrecuentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $preguntasFrecuentes = PreguntaFrecuente::all();
            return response()->json($preguntasFrecuentes);
        }
        
        return view('admin.preguntas_frecuentes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.preguntas_frecuentes.create')
                ->withPreguntaFrecuente(new PreguntaFrecuente());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePreguntaFrecuenteRequest $request)
    {
        try {
            DB::beginTransaction();
            $preguntaFrecuente = PreguntaFrecuente::create($request->only('pregunta', 'respuesta'));
            DB::commit();

            flash('La pregunta frecuente ha sido creada correctamente.')->success();
            return redirect()->route('preguntas-frecuentes.index');
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
    public function edit(PreguntaFrecuente $preguntaFrecuente)
    {
        return view('admin.preguntas_frecuentes.edit')
                ->withPreguntaFrecuente($preguntaFrecuente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreguntaFrecuenteRequest $request, PreguntaFrecuente $preguntaFrecuente)
    {
        try {
            DB::beginTransaction();
            $preguntaFrecuente->update($request->only('pregunta', 'respuesta'));
            DB::commit();

            flash('Pregunta frecuente actualizada correctamente.')->success();
            return redirect()->route('preguntas-frecuentes.index');
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
    public function destroy(PreguntaFrecuente $preguntaFrecuente)
    {
        try {
            $preguntaFrecuente->delete();

            flash('Pregunta frecuente eliminada correctamente.')->success();
            return redirect()->route('preguntas-frecuentes.index');
        } catch (\Throwable $th) {
            flash($e->getMessage())->error();
        }
        return back();
    }
}
