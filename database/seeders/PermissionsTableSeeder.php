<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos para usuario
        Permission::create(['name' => 'user.listar']);
        Permission::create(['name' => 'user.editar']);
        Permission::create(['name' => 'user.crear']);
        Permission::create(['name' => 'user.eliminar']);
        Permission::create(['name' => 'user.cambiarClave']);
        Permission::create(['name' => 'user.asignarRol']);
        Permission::create(['name' => 'user.update']);


        //Permisos para rol
        Permission::create(['name' => 'rol.gestionRoles']);
    
        //Permisos Logs
        Permission::create(['name' => 'logs.actividad']);
       //Permisos para CategoriaProducto

         Permission::create(['name' => 'producto.gestionarProducto']);
         Permission::create(['name' => 'herramienta.gestionarHerramienta']);
        Permission::create(['name' => 'categoria.gestionarCategorias']);
        Permission::create(['name' => 'clientes.gestionarClientes']);
        Permission::create(['name' => 'subcategoria.gestionarSubCategorias']);
        Permission::create(['name' => 'orden.gestionarOrdenes']);
      
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        $user = User::create([  'name' => 'Administrador',
                            'email' => 'admin@gmail.com',
                            'username' => 'admin',
                            'password' => Hash::make('piperp3456')]);

        $user->assignRole('super-admin');






    }
}
