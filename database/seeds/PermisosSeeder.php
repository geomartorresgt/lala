<?php

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$permisos = [
	        [
	            'name'=> 'privilegios_ver',
	            'display_name'=>'Privilegios Ver',
	            'description'=>'Ver',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'privilegios_crear',
	            'display_name'=>'Privilegios Crear',
	            'description'=>'Crear',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'privilegios_editar',
	            'display_name'=>'Privilegios Editar',
	            'description'=>'Editar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'privilegios_eliminar',
	            'display_name'=>'Privilegios Eliminar',
	            'description'=>'Eliminar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'usuarios_ver',
	            'display_name'=>'Usuarios Ver',
	            'description'=>'Ver',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'usuarios_crear',
	            'display_name'=>'Usuarios Crear',
	            'description'=>'Crear',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'usuarios_editar',
	            'display_name'=>'Usuarios Editar',
	            'description'=>'Editar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'usuarios_eliminar',
	            'display_name'=>'Usuarios Eliminar',
	            'description'=>'Eliminar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ]
	    ];

	    Permiso::insert($permisos);
    }
}
