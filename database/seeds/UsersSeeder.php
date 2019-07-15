<?php

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
	            'nombres' => 'admin',
	            'apellidos'=>'apellido',
	            'telefono'=>'+580000000',
	            'email' => 'admin@lala.com',
	            'password' => bcrypt('admin'),
	            'remember_token' => str_random(10),
	            'created_at' => now(),
	            'updated_at' => now()
			]
		];

		// agregando los usuarios
		User::insert($users);
		
		// usuario con rol de administrador
		$userAdmin = User::first();
		$rolAdmin = Rol::where('name', 'admin')->first();
		$userAdmin->attachRole($rolAdmin);
    }
}
