<?php

namespace App\Http\Controllers;

use App\Models\controlAsistencia;
use App\Models\trabajo;
use App\Models\trabajosAsignado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControlAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, trabajosAsignado $trabajo_asignado)
    {
        $hora_actual = Carbon::now()->format('H:i:s');
        if ($request->es_ubicacion_cercana == 1) {
            if ($hora_actual >= $trabajo_asignado->horas->horaInicio && 
                $hora_actual<=  $trabajo_asignado->horas->horaFin) {

                if ($trabajo_asignado->estado == 'Asignado') {
                    $controlAsistencia = new controlAsistencia();
                    $controlAsistencia->trabajos_asignados_id = $trabajo_asignado->id;
                    $controlAsistencia->horaInicio = $hora_actual;
                    $controlAsistencia->horaFin = '00:00:00';
                    $controlAsistencia->latitud = $request->latitud;
                    $controlAsistencia->longitud = $request->longitud;
                    $controlAsistencia->save();

                    $trabajo_asignado->estado = 'En Proceso';
                    $trabajo_asignado->save();
                } elseif ($trabajo_asignado->estado == 'En Proceso') {

                    $controlAsistenciaActual = controlAsistencia::join('trabajos_asignados', 'trabajos_asignados.id', 'trabajos_asignados_id')->select('control_asistencias.*')->where('trabajos_asignados_id', $trabajo_asignado->id)->where('tecnicos_id', $trabajo_asignado->tecnicos_id)->first();


                    /*  dd( $controlAsistenciaActual); */

                    //actualizando la hora de finalizacion del trabajo 

                    $controlAsistenciaActual->horaFin = $hora_actual;
                    $controlAsistenciaActual->latitud = $request->latitud;
                    $controlAsistenciaActual->longitud = $request->longitud;
                    $controlAsistenciaActual->save();


                    //actualizando el estado del trabajo asignado
                    $trabajo_asignado->estado = 'Completado';
                    $trabajo_asignado->save();
                }

            } else {
                return redirect()->back()->with('error', 'Debe empezar a la hora asignada');
            }

        } else {
            return redirect()->back()->with('error', 'se encuentra muy lejos de la ubicacion');
        }



        return redirect()->route('trabajos_asignados_tecnicos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\controlAsistencia  $controlAsistencia
     * @return \Illuminate\Http\Response
     */
    public function show(controlAsistencia $controlAsistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\controlAsistencia  $controlAsistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(controlAsistencia $controlAsistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\controlAsistencia  $controlAsistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, controlAsistencia $controlAsistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\controlAsistencia  $controlAsistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(controlAsistencia $controlAsistencia)
    {
        //
    }
}
