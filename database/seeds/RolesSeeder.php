<?php

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Relations\Relation;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'local',
                'display_name' => 'Local',
                'description' => 'Asignado a un local',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Rol::insert($roles);

        $rolAdmin = Rol::first();
        $permisosAll = Permiso::all();
        $rolAdmin->attachPermissions($permisosAll);

        $rolLocal = Rol::latest('id')->first();
        $permisosLocal = Permiso::whereIn('name', [
                            'mis_presupuestos_ver', 
                            'mis_presupuestos_crear', 
                            'mis_presupuestos_eliminar', 
                            'capturas_eliminar', 
                            'local_mueble_ver', 
                            'local_mueble_crear', 
                            'local_mueble_editar', 
                            'local_mueble_eliminar', 
                            'presupuestos_ver', 
                            'presupuestos_crear', 
                            'presupuestos_editar', 
                            'presupuestos_eliminar',
                            'categorias_muebles_ver',
                        ])->get();
        $rolLocal->attachPermissions($permisosLocal);
    }
}
