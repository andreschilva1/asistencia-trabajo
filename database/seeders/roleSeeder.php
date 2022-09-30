<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2= Role::create(['name' => 'Tecnico']);
        $role3= Role::create(['name' => 'Cliente']);
        
        
        $permission = Permission::create(['name' => 'Gestionar Perfil'])->syncRoles([$role1,$role2]);
        $permission = Permission::create(['name' => 'Seccion Administracion Usuarios'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Usuarios'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Roles'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Bitacora'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Trabajos'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Horas'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Categorias'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Asignar Trabajos'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Gestionar Mis Trabajos Asignados'])->syncRoles([$role2]);
        $permission = Permission::create(['name' => 'Control Asistencia'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'Mi Asistencia'])->syncRoles([$role2]);
        
        
        

        
    }
}
