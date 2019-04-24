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
	        ],

	        // categorias muebles
	        [
	            'name'=> 'categorias_muebles_ver',
	            'display_name'=>'Categorías Muebles Ver',
	            'description'=>'Ver',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'categorias_muebles_crear',
	            'display_name'=>'Categorías Muebles Crear',
	            'description'=>'Crear',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'categorias_muebles_editar',
	            'display_name'=>'Categorías Muebles Editar',
	            'description'=>'Editar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'categorias_muebles_eliminar',
	            'display_name'=>'Categorías Muebles Eliminar',
	            'description'=>'Eliminar',
	            'created_at' => now(),
	            'updated_at' => now()
			],
			
			// muebles
	        [
	            'name'=> 'muebles_ver',
	            'display_name'=>'Muebles Ver',
	            'description'=>'Ver',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'muebles_crear',
	            'display_name'=>'Muebles Crear',
	            'description'=>'Crear',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'muebles_editar',
	            'display_name'=>'Muebles Editar',
	            'description'=>'Editar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'muebles_eliminar',
	            'display_name'=>'Muebles Eliminar',
	            'description'=>'Eliminar',
	            'created_at' => now(),
	            'updated_at' => now()
	        ]
	    ];

	    Permiso::insert($permisos);
    }
}
