<?php

namespace Database\Seeders;

use App\Models\trabajo;
use Illuminate\Database\Seeder;

class trabajos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $trabajo = new trabajo(); 
        $trabajo->nombre="fibra 10";
        $trabajo->descripcion='instalacion de internet fibra optica plan 10Mb';
        $trabajo->categorias_id= 1;
        $trabajo->save();
    }
}
