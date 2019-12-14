<?php

use App\Models\Permiso;
use App\Models\Rol;
use App\Models\User;
use App\Models\CategoriaMueble;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if (App::environment('local')) {
        	// limpiando la bd
        	DB::table('rol_user')->truncate();
            DB::table('permiso_rol')->truncate();
            Rol::truncate();
            Permiso::truncate();
            User::truncate();

            // agregan datos
            $this->call(PermisosSeeder::class);
            $this->call(RolesSeeder::class);
            $this->call(UsersSeeder::class);
            
            $this->call(PreguntasFrecuentesSeeder::class);
            
        }

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
