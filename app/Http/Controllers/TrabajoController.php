<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\trabajo;
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = Trabajo::all();
        return view('Trabajos.index',compact('trabajos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('trabajos.crear', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertar(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);
        
        $trabajo = new trabajo();
        $trabajo->nombre = $request->nombre;
        $trabajo->descripcion = $request->descripcion;
        $trabajo->categorias_id = $request->categoria;
        $trabajo->save();

        return redirect()->route('trabajos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(trabajo $trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(trabajo $trabajo)
    {
        $categorias = categoria::all();
        return view('trabajos.edit',compact('trabajo','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trabajo $trabajo)
    {
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'categoria'=>'required',
            
        ]);

        $trabajo->nombre = $request->nombre;
        $trabajo->descripcion = $request->descripcion;
        $trabajo->categorias_id = $request->categoria;
        $trabajo->save();

        return redirect()->route('trabajos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(trabajo $trabajo)
    {
        $trabajo->delete();
        return redirect()->route('trabajos.index');
    }
}
