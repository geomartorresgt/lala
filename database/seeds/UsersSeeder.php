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
	            'created_at' => now(),
	            'updated_at' => now()
        	]
		];

		User::insert($users);
		$user = User::first();
		$admin = Rol::where('name', 'admin')->first();
        $user->attachRole($admin);
    }
}
