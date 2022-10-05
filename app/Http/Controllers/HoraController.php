<?php

namespace App\Http\Controllers;

use App\Models\hora;
use Illuminate\Http\Request;

class HoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horas = hora::all();
        return view('Horarios.index',compact('horas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Horarios.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertar(Request $request)
    {
        $request->validate([
            'hora_inicio' => 'required',
            'hora_final' => 'required',

        ]);

        $hora = new hora();
        $hora->horaInicio = $request->hora_inicio;
        $hora->horaFin = $request->hora_final;
        $hora->save();
        
        return redirect()->route('horas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function show(hora $hora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function edit(hora $hora)
    {
        return view('Horarios.edit',compact('hora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hora $hora)
    {
        $request->validate([
            'hora_inicio' => 'required',
            'hora_final' => 'required',
        ]);

        $hora->horaInicio = $request->hora_inicio;
        $hora->horaFin = $request->hora_final;
        $hora->save();
        
        return redirect()->route('horas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hora  $hora
     * @return \Illuminate\Http\Response
     */
    public function destroy(hora $hora)
    {
        $hora->delete();
        return redirect()->route('horas.index');
    }
}
