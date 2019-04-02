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
            ]
        ];

        Rol::insert($roles);

        $rolAdmin = Rol::first();
        $permisosAll = Permiso::all();
        $rolAdmin->attachPermissions($permisosAll);
    }
}
