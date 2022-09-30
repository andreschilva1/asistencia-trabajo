<?php

namespace Database\Seeders;

use App\Models\categoria;
use Illuminate\Database\Seeder;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trabajo = new categoria(); 
        $trabajo->nombre="Instalacion";
        $trabajo->save();
    }
}
