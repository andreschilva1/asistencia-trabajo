<?php

namespace App\Http\Controllers;

use App\Models\hora;
use App\Models\trabajo;
use App\Models\trabajosAsignado;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use Database\Seeders\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajosAsignadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos_asignados = trabajosAsignado::trabajosAsignados()->get();
        /* dd($trabajos_asignados); */
        return view('Trabajos_asignados.index',compact('trabajos_asignados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $clientes = User::role('Cliente')->get();
        //manera complicada
        /* $tecnicos = User::join('model_has_roles','model_id','users.id')->join('roles','roles.id','model_has_roles.role_id')
        ->where('roles.name','=','Tecnico')->select('users.id as user_id', 'users.name as user_name')->get(); */
        //manera facil
        $tecnicos = User::role('Tecnico')->get();
        $trabajos = trabajo::all();
        $horas = hora::all();
        
        return view('Trabajos_asignados.crear',compact('clientes','tecnicos','trabajos','horas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insertar(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        /* dd($request); */
        $request->validate([
            'trabajo' => 'required',
            'cliente' => 'required',
            'tecnico' => 'required',
            'fecha' => 'required|after_or_equal:'.$now,
            'hora' => 'required',
            'estado' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        $trabajos_asignados_tecnico = trabajosAsignado::where('tecnicos_id',$request->tecnico)->get();

        $trabajo_encontrado = false;
        foreach ($trabajos_asignados_tecnico as $trabajo_asignado_tecnico) {
            if (($request->fecha == $trabajo_asignado_tecnico->Fecha) && ($request->hora ==$trabajo_asignado_tecnico->horas_id)) {
                $trabajo_encontrado = true;
                break;
            }
        }

        if (!$trabajo_encontrado) {
            $trabajo_asignado = new trabajosAsignado();
            $trabajo_asignado->clientes_id = $request->cliente;
            $trabajo_asignado->tecnicos_id = $request->tecnico;
            $trabajo_asignado->trabajos_id = $request->trabajo;
            $trabajo_asignado->horas_id= $request->hora;
            $trabajo_asignado->Fecha = $request->fecha;
            $trabajo_asignado->estado = $request->estado;
            $trabajo_asignado->latitud = $request->latitud;
            $trabajo_asignado->longitud = $request->longitud;
            
            $trabajo_asignado->save();

            User::find($trabajo_asignado->tecnicos_id)->notify(new InvoicePaid($trabajo_asignado));
        }
       

        return redirect()->route('trabajos_asignados.index');
        
        



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trabajosAsignado  $trabajosAsignado
     * @return \Illuminate\Http\Response
     */
    public function show(trabajosAsignado $trabajosAsignado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trabajosAsignado  $trabajosAsignado
     * @return \Illuminate\Http\Response
     */
    public function edit(trabajosAsignado $trabajo_asignado)
    {
        $old_cliente = User::find($trabajo_asignado->clientes_id);
        $clientes = User::role('Cliente')->get();
        $tecnicos = User::role('Tecnico')->get();
        $trabajos = trabajo::all();
        $horas = hora::all();
        
        return view('Trabajos_asignados.edit',compact('old_cliente','trabajo_asignado','clientes','tecnicos','trabajos','horas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trabajosAsignado  $trabajosAsignado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trabajosAsignado $trabajo_asignado)
    {
        $now = Carbon::now()->format('d-m-Y');    
         $request->validate([
            'trabajo' => 'required',
            'cliente' => 'required',
            'tecnico' => 'required',
            'fecha' => 'required|after_or_equal:'.$now,
            'hora' => 'required',
            'estado' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        $trabajos_asignados_tecnico = trabajosAsignado::where('tecnicos_id',$request->tecnico)->get();

        $trabajo_encontrado = false;
        foreach ($trabajos_asignados_tecnico as $trabajo_asignado_tecnico) {
            if (($request->fecha == $trabajo_asignado_tecnico->Fecha) && ($request->hora ==$trabajo_asignado_tecnico->horas_id)) {
                $trabajo_encontrado = true;
                break;
            }
        }

        if (!$trabajo_encontrado) {
            $trabajo_asignado->clientes_id = $request->cliente;
            $trabajo_asignado->tecnicos_id = $request->tecnico;
            $trabajo_asignado->trabajos_id = $request->trabajo;
            $trabajo_asignado->horas_id= $request->hora;
            $trabajo_asignado->Fecha = $request->fecha;
            $trabajo_asignado->estado = $request->estado;
            $trabajo_asignado->latitud = $request->latitud;
            $trabajo_asignado->longitud = $request->longitud;
            
            $trabajo_asignado->save();
        }
        

        return redirect()->route('trabajos_asignados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trabajosAsignado  $trabajosAsignado
     * @return \Illuminate\Http\Response
     */
    public function destroy(trabajosAsignado $trabajo_asignado)
    {
        
        $trabajo_asignado->delete();
        return redirect()->route('trabajos_asignados.index');
    }
}
