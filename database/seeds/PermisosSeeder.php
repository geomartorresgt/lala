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
			],
			
			// Presupuestos
	        [
	            'name'=> 'presupuestos_ver',
	            'display_name'=>'Presupuestos Ver',
	            'description'=>'Ver Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'presupuestos_crear',
	            'display_name'=>'Presupuestos Crear',
	            'description'=>'Crear Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'presupuestos_editar',
	            'display_name'=>'Presupuestos Editar',
	            'description'=>'Editar Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
	        ],
	        [
	            'name'=> 'presupuestos_eliminar',
	            'display_name'=>'Presupuestos Eliminar',
	            'description'=>'Eliminar Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
			],

			// mis presupuestos
			[
	            'name'=> 'mis_presupuestos_ver',
	            'display_name'=>'Mis Presupuestos Ver',
	            'description'=>'Ver Mis Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
			],
			[
	            'name'=> 'mis_presupuestos_crear',
	            'display_name'=>'Mis Presupuestos Crear',
	            'description'=>'Crear Mis Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
			],
			[
	            'name'=> 'mis_presupuestos_eliminar',
	            'display_name'=>'Mis Presupuestos Eliminar',
	            'description'=>'Eliminar Mis Presupuestos',
	            'created_at' => now(),
	            'updated_at' => now()
			],
			
			// capturas
			[
	            'name'=> 'capturas_eliminar',
	            'display_name'=>'Eliminar Capturas del Presupuesto',
	            'description'=>'Eliminar Capturas del Presupuesto',
	            'created_at' => now(),
	            'updated_at' => now()
			],
	    ];

	    Permiso::insert($permisos);
    }
}
