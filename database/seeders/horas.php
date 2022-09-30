<?php

namespace Database\Seeders;

use App\Models\hora;
use Illuminate\Database\Seeder;

class horas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hora = new hora(); 
        $hora->id=1;
        $hora->horaInicio='07:30:00';
        $hora->horaFin='09:00:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=2;
        $hora->horaInicio='09:30:00';
        $hora->horaFin='10:30:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=3;
        $hora->horaInicio='11:00:00';
        $hora->horaFin='12:30:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=4;
        $hora->horaInicio='13:30:00';
        $hora->horaFin='15:00:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=5;
        $hora->horaInicio='13:30:00';
        $hora->horaFin='15:00:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=6;
        $hora->horaInicio='15:30:00';
        $hora->horaFin='16:30:00';
        $hora->save();

        $hora = new hora(); 
        $hora->id=7;
        $hora->horaInicio='17:00:00';
        $hora->horaFin='18:30:00';
        $hora->save();

        
    }

    
    
}
