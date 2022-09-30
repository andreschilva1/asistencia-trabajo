<?php

namespace Database\Seeders;

use App\Models\trabajo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(roleSeeder::class);
        $this->call(users::class);
        $this->call(categoriaSeeder::class);
        $this->call(trabajos::class);
        $this->call(horas::class);
        
    }
}
