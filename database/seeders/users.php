<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user = new User(); 
            $user->name='andres';
            $user->email='wasulwasol@gmail.com';
            $user->password= bcrypt('12345678');
            $user->save();
            
            $user->assignRole('Admin');

            $user = new User(); 
            $user->name='Daniel';
            $user->email='Daniel@gmail.com';
            $user->password= bcrypt('12345678');
            $user->save();
            
            $user->assignRole('Tecnico');
    }
}
