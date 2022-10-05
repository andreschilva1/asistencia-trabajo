<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class trabajosAsignado extends Model
{
    use HasFactory;
    protected $table = 'trabajos_asignados';

    //Relationship

    //para los tecnicos
    public function users()
    {
        return $this->belongsTo(User::class, 'tecnicos_id');
    }

    public function trabajos()
    {
        return $this->belongsTo(trabajo::class);
    }

    public function horas()
    {
        return $this->belongsTo(hora::class);
    }

  
    public function control_asistencias()
    {
        return $this->hasOne(controlAsistencia::class,'trabajos_asignados_id');
    }

    
    //funciones normales

    // devuelve los trabajos y los datos de todos los clientes
    public static function trabajosAsignados()
    {
        return trabajosAsignado::join('users', 'users.id', 'trabajos_asignados.clientes_id')->select('trabajos_asignados.*', 'users.name')->
        where('trabajos_asignados.estado','<>','Completado');
    }

    public static function trabajosCompletados()
    {
        return trabajosAsignado::join('users', 'users.id', 'trabajos_asignados.clientes_id')->select('trabajos_asignados.*', 'users.name')->
        where('trabajos_asignados.estado','Completado');
    }

    // devuelve los trabajos y los datos de todos los clientes
    public static function userActualCLientes()
    {
        $usuarioActual = Auth::user()->id;
        return trabajosAsignado::join('users', 'users.id', 'trabajos_asignados.clientes_id')->
        select('trabajos_asignados.*', 'users.name')->where('tecnicos_id',$usuarioActual);
    }

    public static function trabajosCompletadosTecnicoActual()
    {
        $usuarioActual = Auth::user()->id;
        return trabajosAsignado::join('users', 'users.id', 'trabajos_asignados.clientes_id')->
        select('trabajos_asignados.*', 'users.name')->where('tecnicos_id',$usuarioActual)->where('trabajos_asignados.estado','Completado');
    }
}
