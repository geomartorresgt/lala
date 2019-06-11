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
	            'nombres' => 'Admin',
	            'apellidos'=>'',
	            'telefono'=>'+580000000',
	            'email' => 'admin@unigres.com',
	            'password' => bcrypt('admin'),
	            'remember_token' => str_random(10),
	            'estado'=> true,
	            'local_id'=> null,
	            'created_at' => now(),
	            'updated_at' => now()
			],
			[
	            'nombres' => 'Local',
	            'apellidos'=>'Local',
	            'telefono'=>'+581000000',
	            'email' => 'local@unigres.com',
	            'password' => bcrypt('local'),
	            'remember_token' => str_random(10),
	            'estado'=> true,
	            'local_id'=> 2,
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
		
		// usuario con rol local(se asocia con un local_id)
		$userLocal = User::latest('id')->first();
		$rolLocal = Rol::latest('id')->first();
		$userLocal->attachRole($rolLocal);
    }
}
